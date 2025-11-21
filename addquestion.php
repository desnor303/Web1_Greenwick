<?php
include 'includes/DatabaseConnection.php';

$users = $pdo->query("SELECT id, name FROM user")->fetchAll();
$modules = $pdo->query("SELECT id, name FROM module")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO question (text, userID, moduleID) 
            VALUES (:text, :userID, :moduleID)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':text', $_POST['text']);
    $stmt->bindValue(':userID', $_POST['userID']);
    $stmt->bindValue(':moduleID', $_POST['moduleID']);
    $stmt->execute();

    header("Location: CW.php");
    exit();
}

$title = "Add Question";

ob_start();
include 'templates/addquestion.html.php';
$output = ob_get_clean();
include 'templates/layout.html.php';
?>
