<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Workout Plan</title>
</head>
<body>
    <h1>Create a New Workout Plan</h1>

    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li style="color: red;"><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="/create-plan" method="POST">
        <label for="title">Workout Title:</label><br>
        <input type="text" id="title" name="title" placeholder="Enter workout title" required><br><br>
        
        <button type="submit">Create Workout</button>
    </form>
</body>
</html>
