<?php
function dd($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

function auth() {
    if (!isset($_SESSION["user"])) {
        header("Location: /login");
        die();
    }
}

function guest() {
    if (isset($_SESSION["user"])) {
        header("Location: /");
        die();
    }
}

function isAdmin() {
    if (!isset($_SESSION["user"]) || !$_SESSION["is_admin"]) {
        header("Location: /login");
        die();
    }
}
?>
