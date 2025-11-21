<?php
require '../includes/DatabaseConnection.php';

$users   = $pdo->query("SELECT id, name FROM user ORDER BY name")->fetchAll();
$modules = $pdo->query("SELECT id, name FROM module ORDER BY name")->fetchAll();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text     = trim($_POST['text'] ?? '');
    $userID   = $_POST['userID'] ?? null;
    $moduleID = $_POST['moduleID'] ?? null;

    if ($text === '') {
        $errors[] = 'Question text is required.';
    }

    if (empty($errors)) {
        // Xử lý upload ảnh (nếu có)
        $imagePath = null;

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
                $imagePath = $targetPath;
            } else {
                $errors[] = 'Failed to upload image.';
            }
        }
    }

    if (empty($errors)) {
        $sql = "INSERT INTO question (text, userID, moduleID, imagePath, date) 
                VALUES (:text, :userID, :moduleID, :imagePath, NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':text', $text);
        $stmt->bindValue(':userID', $userID !== '' ? $userID : null, PDO::PARAM_INT);
        $stmt->bindValue(':moduleID', $moduleID !== '' ? $moduleID : null, PDO::PARAM_INT);
        $stmt->bindValue(':imagePath', $imagePath);

        $stmt->execute();

        header('Location: CW.php');
        exit;
    }
}

$title = "Add Question";

ob_start();
require '../templates/addquestion.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
