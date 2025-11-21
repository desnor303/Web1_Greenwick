<?php
require '../includes/DatabaseConnection.php';

$id = $_GET['id'] ?? null;
if ($id) {
    // FK ON DELETE SET NULL sẽ lo phần còn lại
    $stmt = $pdo->prepare("DELETE FROM module WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: modules.php');
exit;
