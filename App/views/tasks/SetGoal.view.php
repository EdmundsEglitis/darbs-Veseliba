
    <div style="margin-bottom: 1em;">
        <strong>Your current goal:</strong>
        <?= implode(", ", $selectedDays) ?>
    </div>


<?php
function isChecked($day, $selectedDays) {
    return in_array($day, $selectedDays) ? 'checked' : '';
}
?>
<h1>Set Your Workout Goal</h1>


<?php if (!empty($errors)): ?>
    <div style="color: red;">
        <?php foreach ($errors as $err): ?>
            <p><?= htmlspecialchars($err) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST">
    <label>Select workout days:</label><br>
    <?php
    $daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
    foreach ($daysOfWeek as $day): ?>
        <input type="checkbox" name="workout_days[]" value="<?= $day ?>" <?= isChecked($day, $selectedDays) ?>>
        <?= $day ?><br>
    <?php endforeach; ?>
    <br>
    <button type="submit">Save Goal</button>
</form>

