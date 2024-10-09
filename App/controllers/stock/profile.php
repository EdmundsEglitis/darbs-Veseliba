<?php 
auth(); 

require "../App/Core/Database.php";
require "../App/Core/Validator.php";
$config = require("../App/config.php");
$db = new Database($config);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Update username
    if (isset($_POST['update_username'])) {
        $new_username = trim($_POST["new_username"]);
        if (empty($new_username) || strlen($new_username) < 3 || strlen($new_username) > 50) {
            $errors["new_username"] = "Username must be between 3 and 50 characters.";
        } else {
            $query = "SELECT COUNT(*) as count FROM users WHERE username = :username";
            $params = [":username" => $new_username];
            $stmt = $db->execute($query, $params);
            $result = $stmt->fetch();

            if ($result && $result['count'] > 0) {
                $errors["new_username"] = "Username already exists. Please choose another one.";
            } else {
                
                $query = "UPDATE users SET username = :new_username WHERE user_id = :user_id"; 
                $params = [
                    ":user_id" => $_SESSION["user_id"], 
                    ":new_username" => $new_username
                ];
                $stmt = $db->execute($query, $params);
                $_SESSION["username"] = $new_username;

                $_SESSION["flash"] = "Username updated!";
            }
        }
    }

    // Update email
    if (isset($_POST['update_email'])) {
        $new_email = trim($_POST["new_email"]);
        if (!Validator::email($new_email)) {
            $errors["new_email"] = "Invalid email format!";
        } else {
            $query = "UPDATE users SET email = :new_email WHERE user_id = :user_id"; 
            $params = [
                ":user_id" => $_SESSION["user_id"],
                ":new_email" => $new_email
            ];
            $stmt = $db->execute($query, $params);

          
            $_SESSION["email"] = $new_email;

            $_SESSION["flash"] = "Email updated!";

            header("Location: /profile");
            die();
        }
    }

    // Update password
    if (isset($_POST['update_password'])) {
        $new_password = trim($_POST["new_password"]);

        if (empty($new_password) || strlen($new_password) < 8) {
            $errors["new_password"] = "Password must be at least 8 characters long.";
        } else {
            $query = "UPDATE users SET password = :new_password WHERE user_id = :user_id"; 
            $params = [
                ":new_password" => password_hash($new_password, PASSWORD_DEFAULT),
                ":user_id" => $_SESSION["user_id"]
            ];
            $stmt = $db->execute($query, $params);

            $_SESSION["flash"] = "Password updated!";

            header("Location: /profile");
            die();
        }
    }
}

$title = "Profile";
require "../App/views/tasks/profile.view.php";
?>