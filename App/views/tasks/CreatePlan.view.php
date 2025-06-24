
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($title) ?></title>
  <style>
    html, body {
    height: auto;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch; /* smooth scroll on iOS */
}
html, body {
    height: auto;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch; /* smooth scroll on iOS */
}

    body {
      font-family: 'Arial Black', sans-serif;
      background-color: #121212;
      color: #f0f0f0;
      margin: 0;
      padding: 1rem;
    }

    .container {
      max-width: 960px;
      margin: 0 auto;
      padding: 1rem;
    }

    h1 {
      color: #00e676;
      font-size: 2.5rem;
      text-transform: uppercase;
      text-align: center;
      margin-bottom: 1rem;
    }

    h2 {
      color: #ffffff;
      font-size: 1.75rem;
      border-bottom: 2px solid #00e676;
      padding-bottom: 0.25rem;
      margin-top: 2rem;
      margin-bottom: 1rem;
    }

    .flash {
      background-color: #1e1e1e;
      padding: 1rem;
      border-left: 5px solid #00e676;
      border-radius: 4px;
      margin-bottom: 1rem;
    }

    ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    li {
      background: #1e1e1e;
      border-left: 4px solid #00e676;
      padding: 1rem;
      margin-bottom: 1rem;
      border-radius: 6px;
    }

    li strong {
      display: block;
      margin-bottom: 0.5rem;
    }

    img {
      display: block;
      max-width: 100%;
      height: auto;
      border: 2px solid #00e676;
      border-radius: 8px;
      margin-top: 0.5rem;
    }

    form {
      background: #1c1c1c;
      padding: 1.5rem;
      border-radius: 6px;
      margin-top: 2rem;
      box-shadow: 0 0 10px rgba(0,230,118,0.2);
    }

    label {
      display: block;
      color: #00e676;
      font-weight: bold;
      margin-top: 1rem;
    }

    input[type="text"],
    input[type="url"],
    textarea {
      width: 100%;
      padding: 0.75rem;
      margin-top: 0.5rem;
      background: #2a2a2a;
      border: 1px solid #333;
      border-radius: 4px;
      color: #f0f0f0;
      font-size: 1rem;
    }

    textarea {
      resize: vertical;
      min-height: 100px;
    }

    button {
      display: block;
      width: 100%;
      background: #00e676;
      color: #121212;
      font-weight: bold;
      border: none;
      padding: 0.75rem 1.5rem;
      font-size: 1rem;
      border-radius: 4px;
      margin-top: 1.5rem;
      cursor: pointer;
      transition: background 0.2s;
    }

    button:hover {
      background: #00c766;
    }

    @media (max-width: 768px) {
      h1 {
        font-size: 2rem;
      }

      h2 {
        font-size: 1.5rem;
      }

      form {
        padding: 1rem;
      }

      button {
        padding: 0.75rem;
      }
    }

    @media (max-width: 480px) {
      h1 {
        font-size: 1.75rem;
      }

      h2 {
        font-size: 1.25rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1><?= htmlspecialchars($title) ?></h1>

    <?php if (!empty($_SESSION["flash"])): ?>
      <div class="flash"><?= htmlspecialchars($_SESSION["flash"]) ?></div>
      <?php unset($_SESSION["flash"]); ?>
    <?php endif; ?>

    <h2>Exercises for Workout Plan</h2>

    <?php if (empty($exercises)): ?>
      <p>No exercises have been added to this workout plan yet.</p>
    <?php else: ?>
      <ul>
        <?php foreach ($exercises as $exercise): ?>
          <li>
            <strong><?= htmlspecialchars($exercise["exercise_name"]) ?></strong>
            <?= htmlspecialchars($exercise["description"]) ?>
            <?php if (!empty($exercise["photo_url"])): ?>
              <img src="<?= htmlspecialchars($exercise["photo_url"]) ?>" alt="Exercise Image">
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
                              <form action="/" method="POST">
                        <button class="shadow_logout__btn">back home</button>
                    </form>
  </div>
</body>
</html>
