<h2>Login</h2>

<?php if (!empty($errors)): ?>
    <ul class="error-list">
        <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post" action="">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email"
           value="<?= htmlspecialchars($email ?? '') ?>" required>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <input type="submit" value="Login">
</form>
