<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 2rem;
            background-color: #f5f5f5;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #eee;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($title) ?></h1>

    <?php if (!empty($userWorkouts)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Workout Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userWorkouts as $workout) : ?>
                    <tr>
                        <td><?= htmlspecialchars($workout['workout_date']) ?></td>
                        <td><?= htmlspecialchars($workout['workout_name']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>You haven't completed any workouts yet.</p>
    <?php endif; ?>
</body>
</html>
