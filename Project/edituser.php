<?php
require '../includes/init.php';

if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: users.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM user WHERE id = :id");
$stmt->execute([':id' => $id]);
$user = $stmt->fetch();

if (!$user) {
    header('Location: users.php');
    exit;
}

$errors = [];
$name  = $user['name'];
$email = $user['email'];

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
        $stmt = $pdo->prepare("UPDATE user SET name = :name, email = :email WHERE id = :id");
        $stmt->execute([
            ':name'  => $name,
            ':email' => $email,
            ':id'    => $id
        ]);
        header('Location: users.php');
        exit;
    }
}

$title = "Edit User";

ob_start();
require '../templates/userform.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
