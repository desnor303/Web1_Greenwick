<?php
require '../includes/init.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: CW.php');
    exit;
}

// Lấy question
$stmt = $pdo->prepare("SELECT * FROM question WHERE id = :id");
$stmt->execute([':id' => $id]);
$question = $stmt->fetch();

if (!$question) {
    header('Location: CW.php');
    exit;
}

$users   = $pdo->query("SELECT id, name FROM user ORDER BY name")->fetchAll();
$modules = $pdo->query("SELECT id, name FROM module ORDER BY name")->fetchAll();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text     = trim($_POST['text'] ?? '');
    $userID   = $_POST['userID'] ?? null;
    $moduleID = $_POST['moduleID'] ?? null;
    $currentImage = $question['imagePath'];

    if ($text === '') {
        $errors[] = 'Question text is required.';
    }

    // Xử lý upload ảnh mới (nếu có)
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename   = basename($_FILES['image']['name']);
        $extension  = pathinfo($filename, PATHINFO_EXTENSION);
        $newName    = 'q_' . time() . '_' . mt_rand(1000, 9999) . '.' . $extension;
        $targetPath = $uploadDir . $newName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            // Xoá ảnh cũ (nếu muốn, optional)
            if (!empty($currentImage) && file_exists($currentImage)) {
                @unlink($currentImage);
            }
            $currentImage = $targetPath;
        } else {
            $errors[] = 'Failed to upload image.';
        }
    }

    if (empty($errors)) {
        $sql = "UPDATE question
                SET text = :text,
                    userID = :userID,
                    moduleID = :moduleID,
                    imagePath = :imagePath
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':text', $text);
        $stmt->bindValue(':userID', $userID !== '' ? $userID : null, PDO::PARAM_INT);
        $stmt->bindValue(':moduleID', $moduleID !== '' ? $moduleID : null, PDO::PARAM_INT);
        $stmt->bindValue(':imagePath', $currentImage);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        header('Location: CW.php');
        exit;
    }
}

$title = "Edit Question";

ob_start();
require '../templates/editquestion.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
