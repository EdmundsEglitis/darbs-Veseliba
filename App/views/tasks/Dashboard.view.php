<h2>Current Streak: <?= htmlspecialchars($userGoal->getStreak($userId)) ?> days</h2>

<!-- Workout Logging Form -->
<form action="/history" method="POST">
    <h3>Log a Workout:</h3>
    <label for="workout_id">Select a Workout:</label>
    <select name="workout_id" required>
        <?php if (!empty($workouts)): ?>
            <?php foreach ($workouts as $workout): ?>
                <option value="<?= $workout['workout_id'] ?>">
                <?= htmlspecialchars($workout['title']) ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option disabled>No workouts available</option>
        <?php endif; ?>
    </select>
    <button type="submit">Log Workout</button>
</form>

<!-- Flash Messages -->
<?php if (isset($_SESSION["flash"])): ?>
    <p style="color: green;"><?= $_SESSION["flash"] ?></p>
    <?php unset($_SESSION["flash"]); ?>
<?php endif; ?>
