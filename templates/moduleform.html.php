<h2><?= htmlspecialchars($title) ?></h2>

<?php if (!empty($errors)): ?>
    <ul class="error-list">
        <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="" method="post">
    <label for="name">Module name:</label>
    <input type="text" name="name" id="name"
           value="<?= htmlspecialchars($name ?? '') ?>" required>

    <input type="submit" value="Save">
</form>
