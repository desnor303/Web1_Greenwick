<?php
// Bắt đầu session cho toàn site
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kết nối DB
require __DIR__ . '/DatabaseConnection.php';
