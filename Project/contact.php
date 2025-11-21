<?php
require '../includes/init.php';

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
        $sql = "INSERT INTO contact_message
                    (name, email, subject, message, created_at)
                VALUES
                    (:name, :email, :subject, :message, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'    => $name,
            ':email'   => $email,
            ':subject' => $subject,
            ':message' => $message
        ]);

        $success = true;
        $name = $email = $subject = $message = '';
    }
}

$title = "Contact Admin";

ob_start();
require '../templates/contact.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
