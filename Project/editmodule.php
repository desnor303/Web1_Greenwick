<?php
require '../includes/init.php';

if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: modules.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM module WHERE id = :id");
$stmt->execute([':id' => $id]);
$module = $stmt->fetch();

if (!$module) {
    header('Location: modules.php');
    exit;
}

$errors = [];
$name = $module['name'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        $errors[] = 'Module name is required.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE module SET name = :name WHERE id = :id");
        $stmt->execute([
            ':name' => $name,
            ':id'   => $id
        ]);
        header('Location: modules.php');
        exit;
    }
}

$title = "Edit Module";

ob_start();
require 'templates/moduleform.html.php';
$output = ob_get_clean();

require 'templates/layout.html.php';
