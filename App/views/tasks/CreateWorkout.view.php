<?php 
$title = "Create Workout Plan";
include __DIR__ . '/../components/head.php'; 
?>

<style>
  /* Full width body, no margin */
  body {
    font-family: 'Arial Black', sans-serif;
    background-color: #121212;
    color: #f0f0f0;
    margin: 0;
    padding: 0;
  }

  /* Main container to center content and restrict width */
  .page-container {
    max-width: 600px;
    margin: 3rem auto 4rem;
    padding: 2rem 2.5rem;
    background-color: #1e1e1e;
    border-radius: 8px;
    box-shadow: 0 0 12px rgba(0, 230, 118, 0.4);
    color: #f0f0f0;
  }

  /* Heading */
  h1 {
    color: #00e676;
    font-size: 2rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 2rem;
    text-align: center;
  }

  /* Error list */
  ul {
    background-color: #2b1b1b;
    border-left: 5px solid #ff3b3b;
    border-radius: 6px;
    padding: 1rem 1.2rem;
    margin-bottom: 1.8rem;
  }

  li {
    color: #ff3b3b;
    font-weight: bold;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
  }

  /* Form label */
  label {
    display: block;
    font-weight: bold;
    color: #00e676;
    margin-top: 1.5rem;
    font-size: 1.1rem;
  }

  /* Input text */
  input[type="text"] {
    width: 100%;
    padding: 0.85rem 1rem;
    margin-top: 0.5rem;
    border: none;
    border-radius: 6px;
    background-color: #2a2a2a;
    color: #f0f0f0;
    font-size: 1rem;
    box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
    transition: background-color 0.3s ease;
  }

  input[type="text"]:focus {
    outline: none;
    background-color: #383838;
  }

  /* Submit button */
  button {
    margin-top: 2rem;
    width: 100%;
    padding: 0.9rem;
    font-size: 1.1rem;
    font-weight: bold;
    color: #121212;
    background: linear-gradient(90deg, #00e676, #00c766);
    border: none;
    border-radius: 6px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 230, 118, 0.7);
    transition: background 0.3s ease, transform 0.2s ease;
  }

  button:hover {
    background: linear-gradient(90deg, #00c766, #009f4d);
    transform: scale(1.05);
  }

  /* Responsive */
  @media (max-width: 480px) {
    .page-container {
      padding: 1.5rem 1.5rem;
      margin: 2rem auto 3rem;
    }

    h1 {
      font-size: 1.75rem;
    }

    button {
      font-size: 1rem;
      padding: 0.75rem;
    }
  }
</style>

<div class="page-container">
  <h1>Create a New Workout Plan</h1>

  <?php if (!empty($errors)): ?>
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error) ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <form action="/create-plan" method="POST">
    <label for="title">Workout Title:</label>
    <input type="text" id="title" name="title" placeholder="Enter workout title" required>

    <button type="submit">Create Workout</button>
  </form>
</div>
