<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .exercise-list {
            margin-top: 20px;
        }
        .exercise-card {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .exercise-card h3 {
            margin: 0;
            font-size: 24px;
        }
        .exercise-card p {
            font-size: 16px;
            color: #555;
        }
        .exercise-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($title) ?></h1>

    <?php if (!empty($_SESSION["flash"])): ?>
        <p style="color: green;"><?= htmlspecialchars($_SESSION["flash"]) ?></p>
        <?php unset($_SESSION["flash"]); ?>
    <?php endif; ?>

    <?php if (empty($exercises)): ?>
        <p>No exercises have been added to this workout plan yet.</p>
    <?php else: ?>
        <div class="exercise-list">
            <?php foreach ($exercises as $exercise): ?>
                <div class="exercise-card">
                    <h3><?= htmlspecialchars($exercise["exercise_name"]) ?></h3>
                    <p><?= htmlspecialchars($exercise["description"]) ?></p>
                    <?php if (!empty($exercise["photo_url"])): ?>
                        <img src="<?= htmlspecialchars($exercise["photo_url"]) ?>" alt="Exercise Image">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Button to go back to the workout plans page -->
    <a href="/plans class="back-btn">Back to Workout Plans</a>
</body>
</html>
