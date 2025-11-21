<?php
require '../includes/DatabaseConnection.php'; // không bắt buộc, nhưng cứ include cho thống nhất

$errors = [];
$success = false;

$name    = $_POST['name']    ?? '';
$email   = $_POST['email']   ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($name);
    $email   = trim($email);
    $subject = trim($subject);
    $message = trim($message);

    if ($name === '') {
        $errors[] = 'Name is required.';
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email is required.';
    }
    if ($subject === '') {
        $errors[] = 'Subject is required.';
    }
    if ($message === '') {
        $errors[] = 'Message is required.';
    }

    if (empty($errors)) {
        // 2 lựa chọn:
        // 1) Gửi email thật (nếu server cấu hình mail())
        // 2) Ghi vào file log (an toàn cho localhost)
        
        // Ví dụ: ghi log
        $logLine = sprintf(
            "[%s] From: %s <%s> | Subject: %s | Message: %s\n",
            date('Y-m-d H:i:s'),
            $name,
            $email,
            $subject,
            str_replace(["\r", "\n"], ' ', $message)
        );
        file_put_contents('contact_messages.log', $logLine, FILE_APPEND);

        // Nếu muốn dùng mail():
        // @mail('admin@example.com', $subject, $message, "From: $email");

        $success = true;
        // clear form
        $name = $email = $subject = $message = '';
    }
}

$title = "Contact Admin";

ob_start();
require '../templates/contact.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
