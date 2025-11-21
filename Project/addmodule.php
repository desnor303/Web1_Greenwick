<?php
require '../includes/init.php';

if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$errors = [];
$name = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        $errors[] = 'Module name is required.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO module (name) VALUES (:name)");
        $stmt->execute([':name' => $name]);
        header('Location: modules.php');
        exit;
    }
}

$title = "Add Module";

ob_start();
require '../templates/moduleform.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
