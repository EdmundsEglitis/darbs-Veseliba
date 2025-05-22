
<!-- Set Workout Days -->
<!-- Log a Workout -->
<form action="/history" method="POST">
    <h3>Log Your Workout:</h3>
    <label for="workout_id">Select a Workout:</label>
    <select name="workout_id" required>
        <?php if (!empty($workouts)): ?>
            <?php foreach ($workouts as $workout): ?>
                <option value="<?= htmlspecialchars($workout['title']) ?>">
                    <?= htmlspecialchars($workout['title']) ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option disabled>No workouts available</option>
        <?php endif; ?>
    </select>
    <button type="submit" name="log_workout">Log Workout</button>
</form>