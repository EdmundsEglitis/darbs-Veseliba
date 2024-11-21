<?php
require "../App/models/WorkoutPlan.php";

auth(); // Ensure the user is authenticated

$workoutPlan = new WorkoutPlan();

// Validate and parse the workout ID from the query string
$workoutId = isset($_GET['plan_id']) ? intval($_GET['plan_id']) : null;

// Check if the workoutId is valid
if (!$workoutId) {
    $_SESSION["flash"] = "Invalid workout plan.";
    header("Location: /workouts");
    exit;
}

// Handle adding an exercise
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];
    $exerciseName = trim($_POST["exercise_name"]);
    $description = trim($_POST["description"]);
    $photoUrl = !empty($_POST["photo_url"]) ? trim($_POST["photo_url"]) : null;

    // Validate exercise name
    if (empty($exerciseName)) {
        $errors["exercise_name"] = "Exercise name is required.";
    } elseif (strlen($exerciseName) < 3 || strlen($exerciseName) > 255) {
        $errors["exercise_name"] = "Exercise name must be between 3 and 255 characters.";
    }

    // Validate description
    if (empty($description)) {
        $errors["description"] = "Exercise description is required.";
    }

    if (empty($errors)) {
        if ($workoutPlan->addExercise($workoutId, $exerciseName, $description, $photoUrl)) {
            $_SESSION["flash"] = "Exercise added successfully!";
            header("Location: /add-exercises?plan_id=$workoutId"); // Redirect to the same page
            exit;
        } else {
            $errors["general"] = "An error occurred while adding the exercise. Please try again.";
        }
    }
}

// Fetch exercises for the workout plan
$exercises = $workoutPlan->getExercises($workoutId);

$title = "Manage Exercises";
require "../App/views/tasks/CreatePlan.view.php";
