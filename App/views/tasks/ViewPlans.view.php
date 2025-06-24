<?php 
include __DIR__ . '/../components/head.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<style>
  /* Container to center and limit width */
  html, body {
    height: auto;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch; /* smooth scroll on iOS */
}

  .page-content {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 0 1rem;
  }

  h1 {
    color: #00e676;
    margin-bottom: 2rem;
    text-align: center;
  }

  .plans-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1.5rem;
  }

  .card {
    background-color: #1e1e1e;
    border: 1px solid #333;
    border-radius: 10px;
    padding: 1.5rem;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.7);
    max-width: 280px;
    width: 100%;
    text-align: center;
  }

  .card h3 {
    margin: 0 0 0.5rem;
    color: #00e676;
    font-size: 1.3rem;
  }

  .card p {
    margin: 0.5rem 0 1rem;
    color: #ccc;
    font-size: 0.9rem;
  }

  .card a {
    display: inline-block;
    text-decoration: none;
    color: #121212;
    background-color: #00e676;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.3s ease;
    margin: 0.25rem;
  }

  .card a:hover {
    background-color: #00c853;
    transform: scale(1.05);
  }

  p.no-plans {
    background-color: #1e1e1e;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
    text-align: center;
  }

  p.no-plans a {
    color: #00e676;
    text-decoration: underline;
  }
</style>

<div class="page-content">


  <?php if (empty($userPlans)): ?>
    <p class="no-plans">You don't have any workout plans yet. <a href="/create-workout">Create one now!</a></p>
  <?php else: ?>
    <div class="plans-container">
      <?php foreach ($userPlans as $plan): ?>
        <div class="card">
          <h3><?= htmlspecialchars($plan['title']) ?></h3>
          <p>Created: <?= date("F j, Y, g:i a", strtotime($plan['created_at'])) ?></p>
          <a href="/add-exercises?plan_id=<?= $plan['workout_id'] ?>">Add Exercises</a>
          <a href="/view-exercises?plan_id=<?= $plan['workout_id'] ?>">View Workout</a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>


