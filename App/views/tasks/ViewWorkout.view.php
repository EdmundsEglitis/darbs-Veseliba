<?php 
include __DIR__ . '/../components/head.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($title) ?></title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #121212;
      color: #eee;
      margin: 0;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      color: #00e676;
      margin-bottom: 2rem;
      text-align: center;
    }

    .exercise-list {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1.5rem;
      width: 100%;
      max-width: 600px;
    }

    .exercise-card {
      background-color: #1e1e1e;
      border: 1px solid #333;
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
      width: 100%;
    }

    .exercise-card h3 {
      margin: 0 0 0.5rem;
      font-size: 1.3rem;
      color: #00e676;
    }

    .exercise-card p {
      font-size: 1rem;
      color: #ccc;
    }

    .exercise-card img {
      max-width: 100%;
      height: auto;
      border-radius: 5px;
      margin-top: 0.75rem;
    }

    .back-btn {
      display: inline-block;
      margin-top: 2rem;
      padding: 0.75rem 1.5rem;
      background-color: #00e676;
      color: #121212;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .back-btn:hover {
      background-color: #00c853;
      transform: scale(1.05);
    }

    p.flash {
      color: #00e676;
      background-color: #1e1e1e;
      padding: 0.75rem 1rem;
      border-radius: 6px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.6);
      margin-bottom: 1rem;
      text-align: center;
    }

    p.no-exercises {
      background-color: #1e1e1e;
      padding: 1rem;
      border-radius: 6px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.6);
      text-align: center;
    }
  </style>
</head>
<body>
  <h1><?= htmlspecialchars($title) ?></h1>

  <?php if (!empty($_SESSION["flash"])): ?>
    <p class="flash"><?= htmlspecialchars($_SESSION["flash"]) ?></p>
    <?php unset($_SESSION["flash"]); ?>
  <?php endif; ?>

  <?php if (empty($exercises)): ?>
    <p class="no-exercises">No exercises have been added to this workout plan yet.</p>
  <?php else: ?>
    <div class="exercise-list">
      <?php foreach ($exercises as $exercise): ?>
        <div class="exercise-card">
          <h3><?= htmlspecialchars($exercise["exercise_name"]) ?></h3>
          <p><?= htmlspecialchars($exercise["description"]) ?></p>
          <?php if (!empty($exercise["photo_url"])): ?>
            <img src="<?= htmlspecialchars($exercise["photo_url"]) ?>" alt="Exercise Image">
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <a href="/plans" class="back-btn">Back to Workout Plans</a>
</body>
</html>
