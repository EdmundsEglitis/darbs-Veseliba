<?php
require "../App/models/WorkoutPlan.php";

auth(); // Ensure the user is authenticated

$workoutPlan = new WorkoutPlan();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];
    $title = trim($_POST["title"]);

    if (empty($title)) {
        $errors["title"] = "Workout title is required.";
    } elseif (strlen($title) < 3 || strlen($title) > 255) {
        $errors["title"] = "Workout title must be between 3 and 255 characters.";
    }

    if (empty($errors)) {
        if ($workoutPlan->createWorkout($_SESSION["user_id"], $title)) {

            $_SESSION["flash"] = "Workout plan created successfully!";
            header("Location: /workouts");
            exit;
        } else {
            $errors["general"] = "An error occurred while creating the workout plan. Please try again.";
        }
    }
}

// Load the view
$title = "Create Workout Plan";
require "../App/views/tasks/CreateWorkout.view.php";
