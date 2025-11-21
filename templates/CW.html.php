<h2>Student Question Forum</h2>
<p><a href="addquestion.php">Add New Question</a></p>

<table class="jokes-table">
    <thead>
    <tr>
        <th>Question</th>
        <th>Image</th>
        <th>User</th>
        <th>Module</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    </thead>

    <tbody>
    <?php if (empty($questions)): ?>
        <tr>
            <td colspan="6">No questions found.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($questions as $q): ?>
            <tr>
                <td class="joke-text">
                    <?= nl2br(htmlspecialchars($q['text'])) ?>
                </td>
                <td class="joke-image-cell">
                    <?php if (!empty($q['imagePath'])): ?>
                        <img src="<?= htmlspecialchars($q['imagePath']) ?>" 
                             alt="Question image" class="joke-thumbnail">
                    <?php else: ?>
                        <span>No image</span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($q['username'] ?? 'Unknown') ?></td>
                <td><?= htmlspecialchars($q['modulename'] ?? 'Unassigned') ?></td>
                <td class="joke-date-cell">
                    <?= htmlspecialchars($q['date']) ?>
                </td>
                <td class="joke-actions">
                    <a href="editquestion.php?id=<?= $q['id'] ?>">Edit</a>
                    |
                    <a href="deletequestion.php?id=<?= $q['id'] ?>"
                       onclick="return confirm('Delete this question?');">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
