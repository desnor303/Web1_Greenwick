<h2><?= htmlspecialchars($title) ?></h2>

<?php if (!empty($errors)): ?>
    <ul class="error-list">
        <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name"
           value="<?= htmlspecialchars($name ?? '') ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email"
           value="<?= htmlspecialchars($email ?? '') ?>" required>

    <input type="submit" value="Save">
</form>
