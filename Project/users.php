
<?php
require '../includes/init.php';

if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$users = $pdo->query("SELECT id, name, email FROM user ORDER BY name")->fetchAll();

$title = "Users";

ob_start();
require '../templates/users.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
