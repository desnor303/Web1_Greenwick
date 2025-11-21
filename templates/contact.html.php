<h2>Contact Admin</h2>

<?php if ($success): ?>
    <p>Your message has been recorded. Thank you!</p>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <ul class="error-list">
        <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="" method="post">
    <label for="name">Your name:</label>
    <input type="text" id="name" name="name"
           value="<?= htmlspecialchars($name) ?>" required>

    <label for="email">Your email:</label>
    <input type="email" id="email" name="email"
           value="<?= htmlspecialchars($email) ?>" required>

    <label for="subject">Subject:</label>
    <input type="text" id="subject" name="subject"
           value="<?= htmlspecialchars($subject) ?>" required>

    <label for="message">Message:</label>
    <textarea id="message" name="message" required><?= htmlspecialchars($message) ?></textarea>

    <input type="submit" value="Send">
</form>
