<?php require "../App/views/components/head.php"; ?>
<link rel="stylesheet" href="index.css">

<style>




    .profile-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
        
    }

    .profile-content {
        background-color: #1e1e1e;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    .profile-header {
        margin-bottom: 20px;
        font-size: 24px;
        color: #bb86fc;
    }

    .auth-form {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .auth-label {
        display: block;
        margin-right: 10px;
        font-size: 16px;
        color: #e0e0e0;
        flex: 1;
        text-align: left;
    }

    .auth-input {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #333;
        background-color: #1e1e1e;
        color: white;
        width: 150px;
        margin-right: 10px;
    }

    .auth-button {
        padding: 10px 20px;
        background-color: #bb86fc;
        color: #121212;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .auth-button:hover {
        background-color: #9a67ea;
        transform: scale(1.05);
    }

    .invalid-data {
        color: red;
        font-size: 14px;
    }

    .logout-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .shadow_logout__btn {
        padding: 10px 20px;
        background-color: #bb86fc;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .shadow_logout__btn:hover {
        background-color: purple;
        transform: scale(1.05);
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