<?php
include 'includes/DatabaseConnection.php';

$sql = "
SELECT 
    q.id,
    q.text,
    q.date,
    u.name AS username,
    u.email AS useremail,
    m.name AS modulename
FROM question q
LEFT JOIN user u ON q.userID = u.id
LEFT JOIN module m ON q.moduleID = m.id
ORDER BY q.date DESC, q.id DESC
";

$questions = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$title = "Question List";

ob_start();
include 'templates/CW.html.php';
$output = ob_get_clean();
include 'templates/layout.html.php';
?>
