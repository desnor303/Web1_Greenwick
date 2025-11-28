<?php
require '../includes/DatabaseConnection.php';
require '../includes/email_config.php'; // lấy cấu hình SMTP

$errors = [];
$name  = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    // Validate dữ liệu
    if ($name === '') {
        $errors[] = 'Name is required.';
    }
    if ($email === '') {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (empty($errors)) {
        try {
            // Lưu vào CSDL (user chỉ có name + email)
            $stmt = $pdo->prepare("INSERT INTO user (name, email) VALUES (:name, :email)");
            $stmt->execute([
                ':name'  => $name,
                ':email' => $email
            ]);

            // ==========================
            // GỬI EMAIL BẰNG PHPMailer + SMTP
            // ==========================

            // Nạp thư viện PHPMailer (đường dẫn tính từ Project/adduser.php)
            require_once __DIR__ . '/../PHPMailer/src/Exception.php';
            require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
            require_once __DIR__ . '/../PHPMailer/src/SMTP.php';

            // Tạo đối tượng PHPMailer (dùng tên đầy đủ có namespace)
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

            try {
                // Cấu hình SMTP
                $mail->isSMTP();
                $mail->Host       = SMTP_HOST;
                $mail->SMTPAuth   = true;
                $mail->Username   = SMTP_USER;
                $mail->Password   = SMTP_PASS;
                $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = SMTP_PORT;
                $mail->CharSet    = 'UTF-8';

                // Địa chỉ gửi & nhận
                $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
                $mail->addAddress($email, $name);

                // Nội dung email
                $mail->isHTML(false); // text thuần cho đơn giản
                $mail->Subject = 'Student Question Forum - Registration Successful';
                $mail->Body    = "Hi {$name},\n\n"
                               . "You have been successfully registered on the "
                               . "COMP1841 Student Question Forum.\n\n"
                               . "You can now use this email address to interact with the forum.\n\n"
                               . "Best regards,\n"
                               . "Student Forum Admin";

                $mail->send(); // nếu lỗi sẽ nhảy xuống catch dưới

            } catch (\PHPMailer\PHPMailer\Exception $e) {
                // Không cho crash giao diện, chỉ log lại
                error_log('Mailer Error: ' . $e->getMessage());
            }

            // Sau khi insert & (cố gắng) gửi mail xong thì quay về danh sách users
            header('Location: users.php');
            exit;

        } catch (PDOException $e) {
            // 1062 = duplicate entry (trùng email – do UNIQUE index)
            if ($e->errorInfo[1] == 1062) {
                $errors[] = 'This email address is already registered.';
            } else {
                throw $e; // Lỗi khác thì nổ lên để debug
            }
        }
    }
}

$title = "Add User";

ob_start();
require '../templates/userform.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
