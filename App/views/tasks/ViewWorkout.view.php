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
    html, body {
    height: auto;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch; /* smooth scroll on iOS */
}

    body {
      font-family: 'Arial Black', sans-serif;
      background-color: #121212;
      color: #eee;
      margin: 0;
      padding: 1.5rem;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      color: #00e676;
      font-size: 2.5rem;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .flash {
      background: #1e1e1e;
      color: #00e676;
      padding: 0.75rem 1rem;
      border-left: 5px solid #00e676;
      border-radius: 6px;
      margin-bottom: 1rem;
      width: 100%;
      text-align: center;
    }

    .no-exercises {
      background: #1e1e1e;
      padding: 1rem;
      border-radius: 6px;
      text-align: center;
      width: 100%;
    }

    .exercise-list {
      display: grid;
      grid-template-columns: 1fr;
      gap: 1.5rem;
      width: 100%;
    }

    .exercise-card {
      background: #1e1e1e;
      padding: 1rem;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.6);
      border-left: 4px solid #00e676;
    }

    .exercise-card h3 {
      margin: 0 0 0.5rem;
      color: #00e676;
      font-size: 1.4rem;
    }

    .exercise-card p {
      margin: 0;
      color: #ccc;
      font-size: 1rem;
      line-height: 1.5;
    }

    .exercise-card img {
      max-width: 100%;
      height: auto;
      border-radius: 6px;
      margin-top: 0.75rem;
      border: 2px solid #00e676;
    }

    .back-btn {
      margin-top: 2rem;
      padding: 0.75rem 1.5rem;
      background: #00e676;
      color: #121212;
      text-decoration: none;
      font-weight: bold;
      border-radius: 6px;
      transition: background 0.3s, transform 0.2s;
      display: inline-block;
    }

    .back-btn:hover {
      background: #00c853;
      transform: scale(1.05);
    }

    @media (max-width: 600px) {
      h1 {
        font-size: 2rem;
      }

      .exercise-list {
        gap: 1rem;
      }

      .exercise-card h3 {
        font-size: 1.2rem;
      }

      .back-btn {
        width: 100%;
        text-align: center;
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

    <?php if (empty($exercises)): ?>
      <div class="no-exercises">No exercises have been added to this workout plan yet.</div>
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
  </div>
</body>
</html>
