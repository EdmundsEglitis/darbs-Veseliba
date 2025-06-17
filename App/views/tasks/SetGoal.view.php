<?php 
include __DIR__ . '/../components/head.php'; 
?>
<style>
  html, body {
    height: 100%;
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #121212;
    color: #eee;
    display: flex;
    flex-direction: column; /* stack nav + content vertically */
  }

  .navbar {
    width: 100%;
    background-color: #1e1e1e;
    padding: 1rem 2rem;
    box-shadow: 0 2px 6px rgba(0,0,0,0.5);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .navbar a {
    color: #00e676;
    text-decoration: none;
    font-weight: bold;
    margin-right: 1rem;
    transition: color 0.2s ease;
  }

  .navbar a:hover {
    color: #00b44f;
  }

  .container {
    background-color: #1e1e1e;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
    max-width: 400px;
    width: 100%;
    margin: 2rem auto; /* center horizontally with margin */
    text-align: center;
  }

  h1 {
    color: #00e676;
    margin-bottom: 1rem;
  }

  strong {
    color: #00e676;
  }

  .current-goal {
    background-color: #222;
    padding: 0.75rem 1rem;
    border-radius: 6px;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px rgba(0,0,0,0.7);
  }

  .errors {
    background-color: #660000;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    margin-bottom: 1rem;
    text-align: left;
  }

  .errors p {
    margin: 0.25rem 0;
  }

  form {
    text-align: left;
  }

  label {
    font-weight: bold;
    display: block;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
  }

  input[type="checkbox"] {
    margin-right: 0.5rem;
    transform: scale(1.1);
    cursor: pointer;
    accent-color: #00e676;
  }

  button {
    margin-top: 1rem;
    background-color: #00e676;
    border: none;
    padding: 0.75rem 1.25rem;
    color: #121212;
    font-weight: bold;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 100%;
    font-size: 1rem;
  }

  button:hover {
    background-color: #00b44f;
  }

  @media (max-width: 450px) {
    .container {
      padding: 1.5rem;
    }

    .navbar {
      padding: 0.75rem 1rem;
      flex-direction: column;
      align-items: flex-start;
    }

    .navbar a {
      margin-bottom: 0.5rem;
    }
  }
</style>

<?php
function isChecked($day, $selectedDays) {
    return in_array($day, $selectedDays) ? 'checked' : '';
}
?>
<div class="container">
  <h1>Set Your Workout Goal</h1>

  <div class="current-goal">
    <strong>Your current goal:</strong> <?= implode(", ", $selectedDays) ?>
  </div>

  <?php if (!empty($errors)): ?>
    <div class="errors">
      <?php foreach ($errors as $err): ?>
        <p><?= htmlspecialchars($err) ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="POST">
    <label>Select workout days:</label>
    <?php
      $daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
      foreach ($daysOfWeek as $day): ?>
        <label>
          <input type="checkbox" name="workout_days[]" value="<?= $day ?>" <?= isChecked($day, $selectedDays) ?>>
          <?= $day ?>
        </label>
    <?php endforeach; ?>
    <button type="submit">Save Goal</button>
  </form>
</div>
