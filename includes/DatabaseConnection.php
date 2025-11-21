<?php
$host = '127.0.0.1';
$port = '3306';
$dbname = 'cw_database';
$username = 'root';
$password = '';

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";


$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    exit('Database connection failed: ' . $e->getMessage());
}