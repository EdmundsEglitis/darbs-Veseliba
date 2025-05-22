<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

<nav class="navbar">
    <div class="navbar-container">
        <h2 class="navbar-title">ALL 4 HEALTH</h2>
        <div class="navbar-links">

            <!-- History button with GET request -->
            <form action="/history" method="GET">
                <button type="submit">History</button>
            </form>

            <!-- Plans button with GET request -->
            <form action="/plans" method="GET">
                <button type="submit">Plans</button>
            </form>

            <!-- Create Plan button with GET request -->
            <form action="/create-plan" method="GET">
                <button type="submit">Create Plan</button>
            </form>

            <!-- Profile button with GET request -->
            <form action="/profile" method="GET">
                <button type="submit">Profile</button>
            </form>

            <!-- Streak button with GET request -->
            <form action="/streak" method="GET">
                <button type="submit">Streak</button>
            </form>

            <form action="/completedWorkouts" method="GET">
                <button type="submit">completedWorkouts</button>
            </form>

        </div>
    </div>
</nav>
</head>
<body>

