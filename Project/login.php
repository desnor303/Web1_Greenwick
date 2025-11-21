<?php
require __DIR__ . '/../includes/init.php';

$errors = [];
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($email);
    $password = trim($password);

    if ($email === '' || $password === '') {
        $errors[] = 'Email and password are required.';
    } else {
        $sql = "SELECT * FROM user WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if (!$user || $user['password'] !== $password) {
            $errors[] = 'Invalid email or password.';
        } else {
            // Đăng nhập thành công
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role']; // 'admin' hoặc 'student'

            header('Location: CW.php');
            exit;
        }
    }
}

$title = 'Login';

ob_start();
require '../templates/login.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
