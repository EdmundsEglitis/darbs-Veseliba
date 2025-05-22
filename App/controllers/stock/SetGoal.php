<?php
require "../App/models/UserGoal.php";

auth(); // Ensure the user is authenticated

$goalModel = new GoalModel();
$userId = $_SESSION["user_id"] ?? null;

if (!$userId) {
    $_SESSION["flash"] = "You must be logged in to set goals.";
    header("Location: /login");
    exit;
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $workoutDays = $_POST["workout_days"] ?? [];

    if (empty($workoutDays)) {
        $errors["workout_days"] = "Please select at least one workout day.";
    } else {
        $saved = $goalModel->setWorkoutGoal($userId, $workoutDays);
        if ($saved) {
            // ✅ Goal saved — reload this page to get fresh data
            header("Location: /set-goals");
            exit;
        } else {
            $errors["general"] = "An error occurred while setting the goal.";
        }
    }
}

// ✅ Always re-fetch the latest goal for display
$existingGoal = $goalModel->getWorkoutGoal($userId);
$selectedDays = [];

if ($existingGoal && isset($existingGoal['workout_days'])) {
    $selectedDays = explode(",", $existingGoal['workout_days']);
}

$title = "Set Your Workout Goals";
require "../App/views/tasks/SetGoal.view.php";
