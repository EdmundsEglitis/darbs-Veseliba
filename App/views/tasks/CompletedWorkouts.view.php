<?php 
include __DIR__ . '/../components/head.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html, body {
    height: auto;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch; /* smooth scroll on iOS */
}

        body {
            font-family: 'Arial Black', sans-serif;
            padding: 2rem;
            background-color: #121212;
            color: #f0f0f0;
            box-sizing: border-box;
        }

        h1 {
            color: #00e676;
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
        }

        .filter-toggle {
            margin-bottom: 1rem;
            padding: 0.5rem 1rem;
            background-color: #00e676;
            color: #121212;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .filter-toggle:hover {
            background-color: #00c767;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            margin-bottom: 2rem;
            background-color: #1e1e1e;
            padding: 1rem;
            border: 1px solid #333;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0, 230, 118, 0.2);
            transition: all 0.5s ease;
        }

        form.hidden {
            opacity: 0;
            transform: translateY(-10px);
            pointer-events: none;
            max-height: 0;
            overflow: hidden;
        }

        form label {
            font-weight: bold;
            color: #00e676;
        }

        form select,
        form input[type="text"] {
            padding: 0.5rem;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #2a2a2a;
            color: #f0f0f0;
            font-family: 'Arial Black', sans-serif;
        }

        form button {
            padding: 0.5rem 1rem;
            background-color: #00e676;
            color: #121212;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form button:hover {
            background-color: #00c767;
        }

        /* Desktop table */
        table {
            width: 100%;
            border-collapse: collapse;
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

        .actions a {
            color: #00e676;
            margin-right: 10px;
            text-decoration: none;
            font-weight: bold;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        p {
            font-size: 1.1rem;
            background-color: #222;
            padding: 1rem;
            border-left: 5px solid #00e676;
        }

        /* Animations */
        tr.animated {
            opacity: 0;
            transform: translateY(10px);
            animation: fadeSlideUp 0.5s ease forwards;
        }

        @keyframes fadeSlideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Card layout for mobile */
        .mobile-card {
            display: none;
        }

        @media screen and (max-width: 768px) {
            body {
                padding: 1rem;
            }

            h1 {
                font-size: 1.8rem;
                text-align: center;
            }

            form {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-toggle {
                width: 100%;
            }

            table {
                display: none;
            }

            .mobile-card {
                display: block;
                background-color: #1e1e1e;
                border: 1px solid #333;
                border-radius: 10px;
                padding: 1rem;
                margin-bottom: 1rem;
                box-shadow: 0 0 10px rgba(0, 230, 118, 0.2);
            }

            .mobile-card h3 {
                color: #00e676;
                font-size: 1.2rem;
                margin: 0 0 0.5rem;
            }

            .mobile-card p {
                margin: 0.3rem 0;
            }

            .mobile-card .actions {
                margin-top: 0.5rem;
            }

            .mobile-card .actions a {
                display: inline-block;
                margin-right: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Logged Workouts</h1>

        <button class="filter-toggle" onclick="toggleFilters()">Toggle Filters</button>

        <form method="get" id="filterForm">
            <label for="sort">Sort by:</label>
            <select name="sort" id="sort">
                <option value="">-- Select --</option>
                <option value="date_asc" <?= ($_GET['sort'] ?? '') === 'date_asc' ? 'selected' : '' ?>>Date ↑</option>
                <option value="date_desc" <?= ($_GET['sort'] ?? '') === 'date_desc' ? 'selected' : '' ?>>Date ↓</option>
                <option value="name_asc" <?= ($_GET['sort'] ?? '') === 'name_asc' ? 'selected' : '' ?>>Name A-Z</option>
                <option value="name_desc" <?= ($_GET['sort'] ?? '') === 'name_desc' ? 'selected' : '' ?>>Name Z-A</option>
            </select>

            <label for="keyword">Keyword:</label>
            <input type="text" name="keyword" id="keyword" value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">

            <button type="submit">Apply</button>
        </form>

        <?php if (!empty($userWorkouts)) : ?>
            <!-- Desktop Table -->
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Workout Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userWorkouts as $index => $workout) : ?>
                        <tr class="animated" style="animation-delay: <?= $index * 100 ?>ms;">
                            <td><?= htmlspecialchars($workout['workout_date']) ?></td>
                            <td><?= htmlspecialchars($workout['workout_name']) ?></td>
                            <td class="actions">
                                <a href="/edit-workout?id=<?= $workout['id'] ?>">Edit</a>
                                <a href="/delete-workout?id=<?= $workout['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Mobile Cards -->
            <?php foreach ($userWorkouts as $workout) : ?>
                <div class="mobile-card">
                    <h3><?= htmlspecialchars($workout['workout_name']) ?></h3>
                    <p><strong>Date:</strong> <?= htmlspecialchars($workout['workout_date']) ?></p>
                    <div class="actions">
                        <a href="/edit-workout?id=<?= $workout['id'] ?>">Edit</a>
                        <a href="/delete-workout?id=<?= $workout['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php else : ?>
            <p>You haven't completed any workouts yet.</p>
        <?php endif; ?>
    </div>

    <script>
        function toggleFilters() {
            const form = document.getElementById('filterForm');
            form.classList.toggle('hidden');
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('tr.animated').forEach((row, i) => {
                row.style.animationDelay = `${i * 100}ms`;
            });
        });
    </script>
</body>
</html>
