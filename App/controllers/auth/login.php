<?php

require "../App/models/Auth.php";
require "../App/Core/Validator.php";

$auth = new Auth();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    if (!Validator::string($_POST["username"], min:1, max:255)) {
        $errors["username"] = "Incorrect username or password";
    }
    
    if (!Validator::string($_POST["password"], min:1, max:255)) {
        $errors["password"] = "Incorrect username or password";
    }

    $user = $auth->getUser($_POST["username"]);

    if (!$user || !password_verify($_POST["password"], $user["password"])) {
        $errors["username"] = "Incorrect username or password";
    }

    if (empty($errors)) {
        session_start();
        $_SESSION["user"] = true;
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["is_admin"] = $user["admin"] == 1; // Ensure this line correctly sets the admin status
        $_SESSION["username"] = $_POST["username"];
        // Redirect based on admin status
        if ($user["admin"] == 1) {
            header("Location: /");
        } else {
            header("Location: /");
        }
        die();
    }
}

$title = "Log in";
require "../App/views/auth/login.view.php";

unset($_SESSION["flash"]);
?>
