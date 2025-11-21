<h2>Users</h2>

<p><a href="adduser.php">Add New User</a></p>

<table class="jokes-table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($users)): ?>
        <tr><td colspan="3">No users found.</td></tr>
    <?php else: ?>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['name']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td class="joke-actions">
                    <a href="edituser.php?id=<?= $u['id'] ?>">Edit</a> |
                    <a href="deleteuser.php?id=<?= $u['id'] ?>"
                       onclick="return confirm('Delete this user? Questions will be set to NULL user.');">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
