<link rel="stylesheet" href="register.css">

<div class="center">
    <main class="auth-main-reg">
        <div class="auth-div">
            <h1 class="auth-h1">Register</h1>
            <form method="POST" class="auth-form">
                <!-- Username -->
                <label class="auth-label">
                    Username
                    <input class="auth-input" name="username" value="<?= $_POST["username"] ?? "" ?>"/>
                </label>
                <?php if (isset($errors["username"])) { ?>
                    <p class="invalid-data"> <?= $errors["username"] ?> </p>
                <?php } ?>

                <!-- Email -->
                <label class="auth-label">
                    Email
                    <input class="auth-input" type="email" name="email" value="<?= $_POST["email"] ?? "" ?>"/>
                </label>
                <?php if (isset($errors["email"])) { ?>
                    <p class="invalid-data"> <?= $errors["email"] ?> </p>
                <?php } ?>

                <!-- Password -->
                <label class="auth-label">
                    Password
                    <div class="password-container">
                        <input class="auth-input" id="password" type="password" name="password" value="<?= $_POST["password"] ?? "" ?>" />
                        <button type="button" class="show-btn" onclick="togglePassword()">Show</button>
                    </div>
                </label>
                <?php if (isset($errors["password"])) { ?>
                    <p class="invalid-data"> <?= $errors["password"] ?> </p>
                <?php } ?>
                <span class="password-hint">(8 chars: 1 uppercase, 1 number, 1 symbol)</span>

                <!-- Submit -->
                <button class="auth-button">Submit</button>
            </form>
            <a class="auth-link" href="/login">Log-in</a>
        </div>
    </main>
</div>

<script>
function togglePassword() {
    const passwordField = document.getElementById("password");
    const showButton = document.querySelector(".show-btn");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        showButton.textContent = "Hide";
    } else {
        passwordField.type = "password";
        showButton.textContent = "Show";
    }
}
</script>

<?php require "../App/views/components/footer.php" ?>

<style>
    body {
        background-color: #1e1e1e;
        font-family: Arial, sans-serif;
        color: white;
        margin: 0;
        padding: 0;
    }

    .center {
        max-width: 800px;
        margin: 5rem auto;
        padding: 2rem;
    }

    .auth-div {
        background-color: #2a2a2a;
        padding: 3rem;
        border-radius: 20px;
        box-shadow: 0 0 20px rgba(0,0,0,0.5);
    }

    .auth-h1 {
        color: #00e676;
        text-align: center;
        margin-bottom: 2rem;
        font-size: 3rem;
    }

    .auth-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .auth-label {
        display: flex;
        flex-direction: column;
        font-weight: bold;
        font-size: 1.1rem;
    }

    .auth-input {
        padding: 1rem;
        margin-top: 0.5rem;
        border-radius: 10px;
        border: 1px solid #444;
        background-color: #1e1e1e;
        color: white;
        font-size: 1rem;
    }

    .password-container {
        display: flex;
        align-items: center;
    }

    .show-btn {
        background-color: #00e676;
        color: #1e1e1e;
        font-weight: bold;
        border: none;
        border-radius: 20px;
        padding: 0.7rem 1.2rem;
        margin-left: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-size: 0.9rem;
    }

    .show-btn:hover {
        background-color: #00c567;
    }

    .auth-button {
        background-color: #00e676;
        color: #1e1e1e;
        font-weight: bold;
        border: none;
        border-radius: 25px;
        padding: 1rem;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .auth-button:hover {
        background-color: #00c567;
    }

    .auth-link {
        display: block;
        text-align: center;
        color: #00e676;
        margin-top: 1.5rem;
        text-decoration: none;
        font-weight: bold;
        font-size: 1.05rem;
    }

    .auth-link:hover {
        text-decoration: underline;
    }

    .invalid-data {
        color: #ff6666;
        background-color: #441111;
        padding: 0.6rem;
        border-radius: 6px;
        font-size: 0.95rem;
    }

    .password-hint {
        font-size: 0.9rem;
        color: #ccc;
        margin-top: -1rem;
        margin-bottom: 0.5rem;
    }

    /* Responsive Enhancements */
    @media (max-width: 768px) {
        .center {
            padding: 1.5rem;
        }

        .auth-div {
            padding: 2rem;
        }

        .auth-h1 {
            font-size: 2.2rem;
        }

        .auth-input {
            padding: 0.9rem;
            font-size: 1rem;
        }

        .show-btn {
            padding: 0.6rem 1rem;
            font-size: 0.85rem;
        }

        .auth-button {
            padding: 0.9rem;
            font-size: 1rem;
        }

        .auth-label {
            font-size: 1rem;
        }
    }
</style>
