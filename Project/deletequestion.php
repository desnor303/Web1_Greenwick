<?php
require '../includes/DatabaseConnection.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: CW.php');
    exit;
}

// Lấy path ảnh để xoá (optional)
$stmt = $pdo->prepare("SELECT imagePath FROM question WHERE id = :id");
$stmt->execute([':id' => $id]);
$row = $stmt->fetch();

if ($row) {
    if (!empty($row['imagePath']) && file_exists($row['imagePath'])) {
        @unlink($row['imagePath']);
    }

    $del = $pdo->prepare("DELETE FROM question WHERE id = :id");
    $del->execute([':id' => $id]);
}

header('Location: CW.php');
exit;
