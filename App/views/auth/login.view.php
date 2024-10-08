
<link rel="stylesheet" href="login.css">
<form method="POST" class="center"> 
    <main class="auth-main-login">
        <div class="auth-div">
            <h1 class="auth-h1" style="color:#301934">Log-in</h1>
            <form method="POST" class="auth-form">
                <label class="auth-label" style="color:white">
                    Username
                    <input class="auth-input" type="text" name="username" value="<?= $_POST["username"] ?? "" ?>"/>
                </label>
                <br><br>
                
                <label class="auth-label" style="color:white">
                    Password
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
                
                <button class="auth-button" style="background-color:#301934; color:white;">Submit</button>
            </form>
            <a href="/register" style="">Register</a>
            <?php if(isset($_SESSION["flash"])) { ?>
                <p class="flash"> <?=$_SESSION["flash"]?></p>
            <?php } ?>
        </div>
    </main>
</form>

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

<?php require "../App/views/components/footer.php"; ?>

</style>
