<?php


require "../App/models/Auth.php";
require "../App/Core/Validator.php";
$auth = new Auth();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    if (!Validator::string($_POST["username"], $min=3, $max=50)) {
        $errors["username"] = "Username has to be 3-50 chars!";
    }
    
    if (!Validator::email($_POST["email"])) {
        $errors["email"] = "Invalid email format!";
    }

    if (!Validator::password($_POST["password"])) {
        $errors["password"] = "Incorrect password format!";
    }

    $result = $auth->getUser($_POST["username"]);

    if ($result) {
        $errors["username"] = "Username already taken!";
    }

    if (empty($errors)) {
        $auth->register($_POST["username"], $_POST["password"], $_POST["email"]);

        $_SESSION["flash"] = "Registered";
        header("Location: /login");
        die();
    }
}

$title = "Register";
require "../App/views/auth/register.view.php";
?>
