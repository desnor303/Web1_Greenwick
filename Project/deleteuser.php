<?php
require '../includes/DatabaseConnection.php';

$id = $_GET['id'] ?? null;
if ($id) {
    // ON DELETE SET NULL đã cấu hình ở FK, nên chỉ cần xoá user
    $stmt = $pdo->prepare("DELETE FROM user WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: users.php');
exit;
