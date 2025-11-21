<h2>Add New Question</h2>

<form action="" method="post">
    <label>Question:</label>
    <textarea name="text" required></textarea>

    <label>User:</label>
    <select name="userID" required>
        <?php foreach ($users as $u): ?>
        <option value="<?= $u['id'] ?>"><?= $u['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Module:</label>
    <select name="moduleID" required>
        <?php foreach ($modules as $m): ?>
        <option value="<?= $m['id'] ?>"><?= $m['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Submit">
</form>
