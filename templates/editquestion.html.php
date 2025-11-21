<h2>Edit Question</h2>

<?php if (!empty($errors)): ?>
    <ul class="error-list">
        <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="" method="post" enctype="multipart/form-data">
    <label for="text">Question:</label>
    <textarea id="text" name="text" required><?= htmlspecialchars($_POST['text'] ?? $question['text']) ?></textarea>

    <label for="userID">User:</label>
    <select id="userID" name="userID">
        <option value="">-- Select user --</option>
        <?php foreach ($users as $u): ?>
            <option value="<?= $u['id'] ?>"
                <?= (($question['userID'] == $u['id']) || (($_POST['userID'] ?? '') == $u['id'])) ? 'selected' : '' ?>>
                <?= htmlspecialchars($u['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="moduleID">Module:</label>
    <select id="moduleID" name="moduleID">
        <option value="">-- Select module --</option>
        <?php foreach ($modules as $m): ?>
            <option value="<?= $m['id'] ?>"
                <?= (($question['moduleID'] == $m['id']) || (($_POST['moduleID'] ?? '') == $m['id'])) ? 'selected' : '' ?>>
                <?= htmlspecialchars($m['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <p>Current image:</p>
    <?php if (!empty($question['imagePath'])): ?>
        <img src="<?= htmlspecialchars($question['imagePath']) ?>" alt="Current image" class="joke-thumbnail">
    <?php else: ?>
        <span>No image</span>
    <?php endif; ?>

    <label for="image">New image (optional):</label>
    <input type="file" name="image" id="image" accept="image/*">

    <input type="submit" value="Save Changes">
</form>
