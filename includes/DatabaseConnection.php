<?php
$host = '127.0.0.1';
$port = '3306';
$dbname = 'cw_database';
$username = 'root';
$password = '';

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Không thể kết nối DB<br>";
    echo "Lỗi: " . $e->getMessage();
    exit();
}
?>
