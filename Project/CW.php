<?php
require '../includes/init.php';

$sql = "
SELECT 
    q.id,
    q.text,
    q.date,
    q.imagePath,
    u.name AS username,
    u.email AS useremail,
    m.name AS modulename
FROM question q
LEFT JOIN user u ON q.userID = u.id
LEFT JOIN module m ON q.moduleID = m.id
ORDER BY q.date DESC, q.id DESC
";

$questions = $pdo->query($sql)->fetchAll();

$title = "Question List";

ob_start();
require '../templates/CW.html.php';
$output = ob_get_clean();

require '../templates/layout.html.php';
