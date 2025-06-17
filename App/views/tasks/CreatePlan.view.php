<?php 
include __DIR__ . '/../components/head.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        body {
            font-family: 'Arial Black', sans-serif;
            background-color: #121212;
            color: #f0f0f0;
            padding: 2rem;
            max-width: 960px;
            margin: auto;
        }

        h1 {
            color: #00e676;
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
        }

        h2 {
            color: #ffffff;
            font-size: 1.75rem;
            border-bottom: 2px solid #00e676;
            padding-bottom: 0.25rem;
            margin-top: 2rem;
        }

        p {
            font-size: 1.1rem;
        }

        p[style] {
            background-color: #1e1e1e;
            padding: 1rem;
            border-left: 5px solid #00e676;
            font-weight: bold;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-top: 1rem;
        }

        li {
            background-color: #1e1e1e;
            border-left: 4px solid #00e676;
            margin-bottom: 1rem;
            padding: 1rem;
            border-radius: 4px;
        }

        img {
            margin-top: 0.5rem;
            border-radius: 8px;
            border: 2px solid #00e676;
            max-width: 100%;
            height: auto;
        }

        form {
            margin-top: 2rem;
            background-color: #1c1c1c;
            padding: 1.5rem;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0, 230, 118, 0.2);
        }

        label {
            display: block;
            margin-top: 1rem;
            font-weight: bold;
            color: #00e676;
        }

        input[type="text"],
        input[type="url"],
        textarea {
            width: 100%;
            padding: 0.75rem;
            margin-top: 0.5rem;
            border: none;
            border-radius: 4px;
            background-color: #2a2a2a;
            color: #f0f0f0;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            margin-top: 1.5rem;
            background-color: #00e676;
            color: #121212;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            width: 100%;
        }

        button:hover {
            background-color: #00c766;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 1rem;
                font-size: 0.95em;
            }

            h1 {
                font-size: 2rem;
                text-align: center;
            }

            h2 {
                font-size: 1.5rem;
            }

            form {
                padding: 1rem;
            }

            button {
                font-size: 1rem;
                padding: 0.75rem;
            }
        }
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
                    <strong><?= htmlspecialchars($exercise["exercise_name"]) ?></strong><br>
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
        <label for="exercise_name">Exercise Name:</label>
        <input type="text" id="exercise_name" name="exercise_name" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="photo_url">Photo URL (optional):</label>
        <input type="url" id="photo_url" name="photo_url">

        <button type="submit">Add Exercise</button>
    </form>
</body>
</html>
