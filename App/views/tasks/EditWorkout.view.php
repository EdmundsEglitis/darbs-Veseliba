<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Workout</title>
    <style>
        html, body {
    height: auto;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch; /* smooth scroll on iOS */
}

        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #fff;
            padding: 2rem;
        }
        label {
            display: block;
            margin-bottom: 1rem;
        }
        input[type="text"], input[type="date"] {
            padding: 0.5rem;
            width: 100%;
            background: #222;
            color: #fff;
            border: 1px solid #333;
            margin-top: 0.25rem;
        }
        button {
            padding: 0.7rem 1.2rem;
            background: #00e676;
            color: #121212;
            border: none;
            cursor: pointer;
            font-weight: bold;
            margin-top: 1rem;
        }
    </style>
</head>
<body>

<h1>Edit Workout</h1>

<form method="POST" action="/edit-workout">
    <input type="hidden" name="id" value="<?= htmlspecialchars($workout['id']) ?>">

    <label>
        Workout Name:
        <input type="text" name="workout_name" value="<?= htmlspecialchars($workout['workout_name']) ?>" required>
    </label>

    <label>
        Workout Date:
        <input type="date" name="workout_date" value="<?= htmlspecialchars($workout['workout_date']) ?>" required>
    </label>

    <button type="submit">Save Changes</button>
</form>

</body>
</html>
