<?php
require __DIR__ . '/../includes/init.php';

if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$sql = "SELECT * FROM contact_message ORDER BY created_at DESC";
$messages = $pdo->query($sql)->fetchAll();

$title = 'Contact Messages';

ob_start();
?>
<h2>Contact Messages</h2>

<table class="jokes-table">
    <thead>
    <tr>
        <th>From</th>
        <th>Email</th>
        <th>Subject</th>
        <th>Received</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($messages)): ?>
        <tr><td colspan="6">No messages.</td></tr>
    <?php else: ?>
        <?php foreach ($messages as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m['name']) ?></td>
                <td><?= htmlspecialchars($m['email']) ?></td>
                <td><?= htmlspecialchars($m['subject']) ?></td>
                <td><?= htmlspecialchars($m['created_at']) ?></td>
                <td>
                    <?= $m['reply'] ? 'Replied' : 'Pending' ?>
                </td>
                <td class="joke-actions">
                    <a href="admin_reply.php?id=<?= $m['id'] ?>">View / Reply</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<?php
$output = ob_get_clean();

require '../templates/layout.html.php';
