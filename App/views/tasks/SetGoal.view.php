<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
    <h1>Set Your Workout Goal</h1>

    <form method="POST">
        <label>Select workout days:</label><br>
        <input type="checkbox" name="workout_days[]" value="Monday"> Monday <br>
        <input type="checkbox" name="workout_days[]" value="Tuesday"> Tuesday <br>
        <input type="checkbox" name="workout_days[]" value="Wednesday"> Wednesday <br>
        <input type="checkbox" name="workout_days[]" value="Thursday"> Thursday <br>
        <input type="checkbox" name="workout_days[]" value="Friday"> Friday <br>
        <input type="checkbox" name="workout_days[]" value="Saturday"> Saturday <br>
        <input type="checkbox" name="workout_days[]" value="Sunday"> Sunday <br>
        <br>
        <button type="submit">Save Goal</button>
    </form>
</body>
</html>
