<h2>Modules</h2>

<p><a href="addmodule.php">Add New Module</a></p>

<table class="jokes-table">
    <thead>
    <tr>
        <th>Module Name</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($modules)): ?>
        <tr><td colspan="2">No modules found.</td></tr>
    <?php else: ?>
        <?php foreach ($modules as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m['name']) ?></td>
                <td class="joke-actions">
                    <a href="editmodule.php?id=<?= $m['id'] ?>">Edit</a> |
                    <a href="deletemodule.php?id=<?= $m['id'] ?>"
                       onclick="return confirm('Delete this module? Questions will be set to NULL module.');">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
