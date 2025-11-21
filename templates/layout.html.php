<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'COMP1841 Coursework') ?></title>
    <link rel="stylesheet" href="CW.css">
</head>
<body>
<header><h1>COMP1841 Coursework – Student Question Forum</h1></header>

<nav>
    <ul>
        <li><a href="CW.php">Questions</a></li>
        <li><a href="addquestion.php">Add Question</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="modules.php">Modules</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
</nav>

<main>
    <?= $output ?? '' ?>
</main>

<footer>&copy; 2025 Student Forum</footer>
</body>
</html>
