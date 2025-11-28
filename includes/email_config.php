<?php
// CẤU HÌNH SMTP THẬT – KHÔNG ĐƯỢC PUSH LÊN GIT

// SMTP server (Gmail)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 465);

// Tài khoản SMTP (nên là 1 Gmail dành cho dev/test)
define('SMTP_USER', 'datha9620@gmail.com');          // <-- sửa
define('SMTP_PASS', 'fqrdrdnoyrjmhoqg');    // <-- sửa (App Password 16 ký tự)

// Thông tin From hiển thị cho người nhận (ẩn danh, không lộ Gmail)
define('SMTP_FROM', 'no-reply@studentforum.local');
define('SMTP_FROM_NAME', 'Student Forum');
