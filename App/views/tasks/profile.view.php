
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fitness Tracker</title>
    <link rel="stylesheet" href="index.css">
</head>
<?php require "../App/views/components/head.php"; ?>
<style>
  body {
    margin: 0;
    font-family: 'Arial Black', sans-serif;
    background-color: #121212;
    color: #f0f0f0;
  }

  .profile-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2rem;
    min-height: 100vh;
  }

  .profile-content {
    background-color: #1e1e1e;
    padding: 2rem 2.5rem;
    border-radius: 8px;
    box-shadow: 0 0 12px rgba(0, 230, 118, 0.4);
    max-width: 600px;
    width: 100%;
  }

  .profile-header {
    font-size: 2rem;
    text-align: center;
    color: #00e676;
    margin-bottom: 2rem;
  }

  .admin-badge {
    font-size: 1rem;
    color: #bb86fc;
    margin-left: 0.5rem;
  }

  .auth-form {
    margin-bottom: 1.5rem;
  }

  .auth-label {
    display: block;
    font-weight: bold;
    color: #00e676;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
  }

  .auth-input {
    width: 100%;
    padding: 0.85rem 1rem;
    border: none;
    border-radius: 6px;
    background-color: #2a2a2a;
    color: #f0f0f0;
    font-size: 1rem;
    box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
    margin-bottom: 1rem;
    transition: background-color 0.3s ease;
  }

  .auth-input:focus {
    background-color: #383838;
    outline: none;
  }

  .auth-button {
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

  .auth-button:hover {
    background: linear-gradient(90deg, #00c766, #009f4d);
    transform: scale(1.05);
  }

  .invalid-data {
    color: #ff3b3b;
    font-size: 0.9rem;
    margin-top: -0.5rem;
    margin-bottom: 1rem;
    font-weight: bold;
  }

  .profile-logout-box {
    margin-top: 2.5rem;
    text-align: center;
  }

  .profile-logout-box h2 {
    font-size: 1.5rem;
    color: #00e676;
    margin-bottom: 1rem;
  }

  .logout-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    justify-content: center;
  }

  .shadow_logout__btn {
    padding: 0.9rem 1.5rem;
    font-size: 1rem;
    font-weight: bold;
    color: #121212;
    background: linear-gradient(90deg, #00e676, #00c766);
    border: none;
    border-radius: 6px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 230, 118, 0.7);
    transition: background 0.3s ease, transform 0.2s ease;
  }

  .shadow_logout__btn:hover {
    background: linear-gradient(90deg, #00c766, #009f4d);
    transform: scale(1.05);
  }

  @media (max-width: 600px) {
    .profile-content {
      padding: 1.5rem;
    }

    .auth-button,
    .shadow_logout__btn {
      width: 100%;
    }

    .logout-buttons {
      flex-direction: column;
      align-items: stretch;
    }
  }
</style>

<main class="create-edit-main">
    <div class="profile-container">
        <div class="profile-content">
            <h1 class="profile-header" style="color:white;">Hello, <?= htmlspecialchars($_SESSION["username"]) ?> 👋🏼
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                    <span class="admin-badge" style="color:#bb86fc">(Admin)</span>
                <?php endif; ?>
            </h1>
            <div class="profile-div">
                <form method="POST" class="auth-form" onsubmit="return confirm('Are you sure you want to change your username?');">
                    <label class="auth-label">New Username:</label>
                    <input class="auth-input" type="text" name="new_username" value="<?= $_POST["new_username"] ?? "" ?>"/>
                    <button class="auth-button" name="update_username">Update</button>
                </form>
                <?php if (isset($errors["new_username"])) { ?>
                    <p class="invalid-data"> <?= $errors["new_username"] ?> </p>
                <?php } ?>
            </div>
            <div class="profile-div">
                <form method="POST" class="auth-form" onsubmit="return confirm('Are you sure you want to change your email address?');">
                    <label class="auth-label">New Email:</label>
                    <input class="auth-input" type="email" name="new_email" value="<?= $_POST["new_email"] ?? "" ?>"/>
                    <button class="auth-button" name="update_email">Update</button>
                </form>
                <?php if (isset($errors["new_email"])) { ?>
                    <p class="invalid-data"> <?= $errors["new_email"] ?> </p>
                <?php } ?>
                <form method="POST" class="auth-form" onsubmit="return confirm('Are you sure you want to change your password?');">
                    <label class="auth-label">New Password:</label>
                    <input class="auth-input" type="password" name="new_password"/>
                    <button class="auth-button" name="update_password">Update</button>
                </form>
                <?php if (isset($errors["new_password"])) { ?>
                    <p class="invalid-data"> <?= $errors["new_password"] ?> </p>
                <?php } ?>
            </div>
            <div class="profile-logout-box">
                <h2>Log out?</h2>
                <div class="logout-buttons">
                    <form action="/logout" method="POST">
                        <button class="shadow_logout__btn">Logout</button>
                    </form>
                    <form action="/" method="POST">
                        <button class="shadow_logout__btn">Home</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require "../App/views/components/footer.php"; ?>