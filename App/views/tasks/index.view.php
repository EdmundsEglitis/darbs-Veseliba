<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fitness Tracker</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
    <style>
      html, body {
    height: auto;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch; /* smooth scroll on iOS */
}

        .flash {
  color: green;
  font-weight: bold;
}

input, button {
  padding: 8px;
  margin-top: 10px;
}
    </style>
<body>
  <?php require "../App/views/components/head.php"; ?>

  <div class="home-content">
    <h1>Welcome back to your Fitness Tracker</h1>

    <p>Your current streak: <strong><?php echo htmlspecialchars($streak); ?></strong> 🔥</p>
  </div>

</body>

</body>
</html>
