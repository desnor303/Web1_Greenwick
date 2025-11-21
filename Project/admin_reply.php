<?php
require '../includes/init.php';

if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: admin_messages.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM contact_message WHERE id = :id");
$stmt->execute([':id' => $id]);
$message = $stmt->fetch();

if (!$message) {
    header('Location: admin_messages.php');
    exit;
}

$errors = [];
$reply = $_POST['reply'] ?? $message['reply'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reply = trim($reply);

    if ($reply === '') {
        $errors[] = 'Reply cannot be empty.';
    } else {
        $sql = "UPDATE contact_message
                SET reply = :reply,
                    replied_at = NOW()
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':reply' => $reply,
            ':id'    => $id
        ]);
        header('Location: admin_messages.php');
        exit;
    }
}

$title = 'Reply to Message';

ob_start();
?>
<h2>Reply to Message</h2>

<p><strong>From:</strong> <?= htmlspecialchars($message['name']) ?>
    (<?= htmlspecialchars($message['email']) ?>)</p>
<p><strong>Subject:</strong> <?= htmlspecialchars($message['subject']) ?></p>
<p><strong>Message:</strong><br>
    <?= nl2br(htmlspecialchars($message['message'])) ?></p>

<?php if (!empty($errors)): ?>
    <ul class="error-list">
        <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post" action="">
    <label for="reply">Admin reply:</label>
    <textarea id="reply" name="reply" required><?= htmlspecialchars($reply ?? '') ?></textarea>
    <input type="submit" value="Send Reply">
</form>
<?php
$output = ob_get_clean();

require '../templates/layout.html.php';
