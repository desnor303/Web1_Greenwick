<?php
require '../includes/init.php';

if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$modules = $pdo->query("SELECT id, name FROM module ORDER BY name")->fetchAll();

$title = "Modules";

ob_start();
require '../templates/modules.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
