<?php
include __DIR__ . '/../components/head.php';
?>

<style>
  /* Container for page content */
  .page-container {
    max-width: 600px;
    margin: 3rem auto 4rem;
    padding: 1rem 2rem;
    background-color: #1e1e1e;
    border-radius: 8px;
    box-shadow: 0 0 12px rgba(0, 230, 118, 0.4);
    color: #f0f0f0;
    font-family: 'Arial Black', sans-serif;
  }

  /* Headings */
  h2 {
    color: #00e676;
    font-size: 2rem;
    margin-bottom: 1.5rem;
    text-align: center;
  }

  h3 {
    color: #fff;
    font-size: 1.5rem;
    margin-bottom: 1rem;
  }

  /* Form label */
  label {
    display: block;
    margin-top: 1.5rem;
    font-weight: bold;
    color: #00e676;
  }

  /* Select dropdown */
  select {
    width: 100%;
    padding: 0.75rem 1rem;
    margin-top: 0.5rem;
    border-radius: 6px;
    border: none;
    background-color: #2a2a2a;
    color: #f0f0f0;
    font-size: 1rem;
    font-weight: bold;
    box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
    transition: background-color 0.3s ease;
  }

  select:focus {
    outline: none;
    background-color: #383838;
  }

  /* Submit button */
  button {
    margin-top: 2rem;
    width: 100%;
    padding: 0.85rem;
    font-size: 1.1rem;
    font-weight: bold;
    color: #121212;
    background: linear-gradient(90deg, #00e676, #00c766);
    border: none;
    border-radius: 6px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0, 230, 118, 0.7);
    transition: background 0.3s ease, transform 0.2s ease;
  }

  button:hover {
    background: linear-gradient(90deg, #00c766, #009f4d);
    transform: scale(1.05);
  }

  /* Flash message */
  p.flash {
    margin-top: 2rem;
    padding: 1rem 1.5rem;
    background-color: #003300;
    border-left: 5px solid #00e676;
    border-radius: 6px;
    color: #00ff88;
    font-weight: bold;
    box-shadow: 0 0 8px #00e676;
  }

  /* Responsive for small screens */
  @media (max-width: 480px) {
    .page-container {
      padding: 1rem 1.2rem;
      margin: 2rem auto 3rem;
    }

    h2 {
      font-size: 1.6rem;
    }

    h3 {
      font-size: 1.3rem;
    }

    button {
      font-size: 1rem;
      padding: 0.75rem;
    }
  }
</style>

<div class="page-container">
  <h2>Current Streak: <?= htmlspecialchars($userGoal->getStreak($userId)) ?> days</h2>

  <form action="/history" method="POST">
    <h3>Log a Workout:</h3>

    <label for="workout_id">Select a Workout:</label>
    <select id="workout_id" name="workout_id" required>
      <?php if (!empty($workouts)): ?>
        <?php foreach ($workouts as $workout): ?>
          <option value="<?= $workout['workout_id'] ?>">
            <?= htmlspecialchars($workout['title']) ?>
          </option>
        <?php endforeach; ?>
      <?php else: ?>
        <option disabled>No workouts available</option>
      <?php endif; ?>
    </select>

    <button type="submit">Log Workout</button>
  </form>

  <?php if (isset($_SESSION["flash"])): ?>
    <p class="flash"><?= htmlspecialchars($_SESSION["flash"]) ?></p>
    <?php unset($_SESSION["flash"]); ?>
  <?php endif; ?>
</div>

