<?php
require "../App/models/UserGoal.php";

auth(); // Ensure the user is authenticated

$userGoal = new GoalModel();
$userId = $_SESSION["user_id"] ?? null;

if (!$userId) {
    $_SESSION["flash"] = "You must be logged in.";
    header("Location: /login");
    exit;
}

// Get the workouts the user has created
$workouts = $userGoal->getUserWorkouts($userId);

// Handle workout log submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $workoutId = $_POST["workout_id"] ?? null;

    if (!$workoutId) {
        $_SESSION["flash"] = "Please select a workout.";
    } else {
        $workout = $userGoal->getWorkoutById($userId, $workoutId);
        if (!$workout) {
            
            $_SESSION["flash"] = "Invalid workout selection.";
        } else {
            // Insert into workout_logs
            var_dump($workout["title"]);
            $logged = $userGoal->logWorkoutWithName($userId, $workout["title"]);

            if ($logged) {
                $_SESSION["flash"] = "Workout logged: " . htmlspecialchars($workout["title"]);
            } else {
                $_SESSION["flash"] = "Failed to log workout.";
            }
        }
    }

    header("Location: /history");
    exit;
}

$title = "Log Workout";
require "../App/views/tasks/dashboard.view.php";
