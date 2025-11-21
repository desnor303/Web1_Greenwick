<h2>Student Question Forum</h2>
<p><a href="addquestion.php">Add New Question</a></p>

<table class="jokes-table">
<thead>
<tr>
    <th>Question</th>
    <th>User</th>
    <th>Module</th>
    <th>Date</th>
</tr>
</thead>

<tbody>
<?php foreach ($questions as $q): ?>
<tr>
    <td><?= htmlspecialchars($q['text']) ?></td>
    <td><?= htmlspecialchars($q['username']) ?></td>
    <td><?= htmlspecialchars($q['modulename']) ?></td>
    <td><?= $q['date'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
