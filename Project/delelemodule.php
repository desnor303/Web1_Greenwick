<?php
require '../includes/init.php';

if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'] ?? null;
if ($id) {
    // FK ON DELETE SET NULL sẽ lo phần còn lại
    $stmt = $pdo->prepare("DELETE FROM module WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: modules.php');
exit;
