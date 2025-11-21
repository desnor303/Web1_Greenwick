<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'COMP1841 Coursework') ?></title>
    <link rel="stylesheet" href="../CW.css"><!-- chỉnh path nếu cần -->
</head>
<body>
<header><h1>COMP1841 Coursework – Student Question Forum</h1></header>

<nav>
    <ul>
        <li><a href="../Project/CW.php">Questions</a></li>
        <li><a href="../Project/addquestion.php">Add Question</a></li>

        <?php if (!empty($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <li><a href="../Project/users.php">Users</a></li>
            <li><a href="../Project/modules.php">Modules</a></li>
            <li><a href="../Project/admin_messages.php">Contact Messages</a></li>
        <?php endif; ?>

        <li><a href="../Project/contact.php">Contact</a></li>

        <?php if (empty($_SESSION['user_id'])): ?>
            <li style="float:right"><a href="../Project/login.php">Login</a></li>
        <?php else: ?>
            <li style="float:right">
                <span>Hi, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                <a href="../Project/logout.php">Logout</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<main>
    <?= $output ?? '' ?>
</main>

<footer>&copy; 2025 Student Forum</footer>
</body>
</html>
