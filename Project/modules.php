<?php
require '../includes/DatabaseConnection.php';

$modules = $pdo->query("SELECT id, name FROM module ORDER BY name")->fetchAll();

$title = "Modules";

ob_start();
require '../templates/modules.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
