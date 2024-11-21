<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        /* Add your CSS styling here */
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($title) ?></h1>

    <?php if (!empty($_SESSION["flash"])): ?>
        <p style="color: green;"><?= htmlspecialchars($_SESSION["flash"]) ?></p>
        <?php unset($_SESSION["flash"]); ?>
    <?php endif; ?>

    <h2>Exercises for Workout Plan</h2>

    <?php if (empty($exercises)): ?>
        <p>No exercises have been added to this workout plan yet.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($exercises as $exercise): ?>
                <li>
                    <strong><?= htmlspecialchars($exercise["exercise_name"]) ?></strong>: 
                    <?= htmlspecialchars($exercise["description"]) ?>
                    <?php if (!empty($exercise["photo_url"])): ?>
                        <br><img src="<?= htmlspecialchars($exercise["photo_url"]) ?>" alt="Exercise Image" width="200">
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <h2>Add a New Exercise</h2>
    <form action="/add-exercises?plan_id=<?= htmlspecialchars($workoutId) ?>" method="POST">
        <label for="exercise_name">Exercise Name:</label><br>
        <input type="text" id="exercise_name" name="exercise_name" required><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br>

        <label for="photo_url">Photo URL (optional):</label><br>
        <input type="url" id="photo_url" name="photo_url"><br>

        <button type="submit">Add Exercise</button>
    </form>
</body>
</html>
