
<link rel="stylesheet" href="register.css">
<div class="center">
<main class="auth-main-reg">
    <div class="auth-div">
        <h1 class="auth-h1" style="color:#301934">Register</h1>
        <form method="POST" class="auth-form">
            <label class="auth-label" style="color:white">
                Username
                <input class="auth-input" name="username" value="<?= $_POST["username"] ?? "" ?>"/>
            </label>
            <?php if (isset($errors["username"])) { ?>
                <p class="invalid-data"> <?= $errors["username"] ?> </p>
            <?php } ?>
            <label class="auth-label" style="color:white">
                Email
                <input class="auth-input" type="email" name="email" value="<?= $_POST["email"] ?? "" ?>"/>
            </label>
            <?php if (isset($errors["email"])) { ?>
                <p class="invalid-data"> <?= $errors["email"] ?> </p>
            <?php } ?>
            <label class="auth-label" style="color:white">
                Password
                <br>
                <div class="password-container">
                    <input class="auth-input" id="password" type="password" name="password" value="<?= $_POST["password"] ?? "" ?>" />
                    <button type="button" class="show-btn" onclick="togglePassword()">
                        Show
                    </button>
                </div>
            </label>
            <?php if (isset($errors["password"])) { ?>
                <p class="invalid-data"> <?= $errors["password"] ?> </p>
            <?php } ?>
            <span style="font-size: 12px; color:white;">(8 chars: 1 uppercase, 1 number, 1 symbol)</span>
            <button class="auth-button" style="background-color:#301934; color:white;">Submit</button>
        </form>
        <a href="/login">Log-in</a>
    </div>
</main>
</div>

<script>
function togglePassword() {
    var passwordField = document.getElementById("password");
    var showButton = document.querySelector(".show-btn");
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
    .password-container {
    display: flex;
    align-items: center;
}

.show-btn {
    background-color: #301934;
    border-radius:20px;
    border: none;
    width: 100px;
    color: white;
    padding: 8px;
    cursor: pointer;
    margin-left: 10px;
}

.show-btn:hover {
    background-color: purple;
    transition: 0.5s;
}

</style>