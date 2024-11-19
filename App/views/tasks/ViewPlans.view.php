<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Workout Plans</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            margin: 16px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 300px;
        }
        .card h3 {
            margin: 0 0 8px;
        }
        .card p {
            margin: 8px 0;
            color: #555;
        }
        .card a {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 8px 12px;
            border-radius: 4px;
        }
        .card a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Your Workout Plans</h1>

    <?php if (empty($userPlans)): ?>
        <p>You don't have any workout plans yet. <a href="/create-workout">Create one now!</a></p>
    <?php else: ?>
        <div class="plans-container">
            <?php foreach ($userPlans as $plan): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($plan['title']) ?></h3>
                    <p>Created: <?= date("F j, Y, g:i a", strtotime($plan['created_at'])) ?></p>
                    <a href="/add-exercises?plan_id=<?= $plan['workout_id'] ?>">Add Exercises</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>
