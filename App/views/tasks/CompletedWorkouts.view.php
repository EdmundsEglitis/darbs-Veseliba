<?php 
include __DIR__ . '/../components/head.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        body {
            font-family: 'Arial Black', sans-serif;
            padding: 2rem;
            background-color: #121212;
            color: #f0f0f0;
        }

        h1 {
            color: #00e676; /* bright green accent */
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            background-color: #1e1e1e;
            box-shadow: 0 0 10px rgba(0, 230, 118, 0.3);
        }

        th, td {
            padding: 14px 18px;
            border: 1px solid #333;
            font-size: 1rem;
        }

        th {
            background-color: #00e676;
            color: #121212;
            text-align: left;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #2a2a2a;
        }

        tr:hover {
            background-color: #333;
        }

        p {
            font-size: 1.1rem;
            background-color: #222;
            padding: 1rem;
            border-left: 5px solid #00e676;
        }
    </style>
</head>
<body>


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
