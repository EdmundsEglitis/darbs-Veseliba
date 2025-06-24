<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title ?? "Fitness Tracker" ?></title>
  <style>
    /* Reset & base */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Arial Black', sans-serif;
      background-color: #121212;
      color: #f0f0f0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      overflow: hidden;
    }

    .navbar {
      background-color: #1e1e1e;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      border-bottom: 2px solid #00e676;
    }

    .navbar-title {
      color: #00e676;
      font-size: 1.5rem;
      text-transform: uppercase;
    }

    .navbar-links {
      display: flex;
      gap: 0.5rem;
      flex-wrap: wrap;
    }

    .navbar-links form {
      margin: 0;
    }

    .navbar-links button {
      background-color: #00e676;
      color: #121212;
      font-weight: bold;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .navbar-links button:hover {
      background-color: #00c766;
    }

    .page-content {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        align-items: flex-start;
      }

      .navbar-links {
        width: 100%;
        justify-content: flex-start;
        gap: 0.5rem;
        margin-top: 1rem;
      }

      .navbar-links button {
        width: 100%;
      }

      .page-content {
        padding: 1rem;
      }
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <h2 class="navbar-title">ALL 4 HEALTH</h2>
    <div class="navbar-links">
      <form action="/" method="GET"><button type="submit">Home</button></form>
      <form action="/history" method="GET"><button type="submit">Log workout</button></form>
      <form action="/plans" method="GET"><button type="submit">Plans</button></form>
      <form action="/create-plan" method="GET"><button type="submit">Create Plan</button></form>
      <form action="/profile" method="GET"><button type="submit">Profile</button></form>
      <form action="/streak" method="GET"><button type="submit">Streak</button></form>
      <form action="/completedWorkouts" method="GET"><button type="submit">Completed Workouts</button></form>
    </div>
  </nav>
  <div class="page-content">
