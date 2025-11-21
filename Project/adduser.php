<?php
require '../includes/init.php';

if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$errors = [];
$name  = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($name === '') {
        $errors[] = 'Name is required.';
    }
    if ($email === '') {
        $errors[] = 'Email is required.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO user (name, email) VALUES (:name, :email)");
        $stmt->execute([
            ':name'  => $name,
            ':email' => $email
        ]);
        header('Location: users.php');
        exit;
    }
}

$title = "Add User";

ob_start();
require '../templates/userform.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
