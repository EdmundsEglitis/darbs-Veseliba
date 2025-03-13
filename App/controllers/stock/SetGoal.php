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

// Handle goal submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];

    // Validate workout days
    $workoutDays = $_POST["workout_days"] ?? [];
    if (empty($workoutDays)) {
        $errors["workout_days"] = "Please select at least one workout day.";
    }

    if (empty($errors)) {
        if ($goalModel->setWorkoutGoal($userId, $workoutDays)) {
            $_SESSION["flash"] = "Workout goal set successfully!";
            header("Location: /set-goals");
            exit;
        } else {
            $errors["general"] = "An error occurred while setting the goal. Please try again.";
        }
    }
}

// Fetch existing goals
$existingGoal = $goalModel->getWorkoutGoal($userId);

$title = "Set Your Workout Goals";
require "../App/views/tasks/SetGoal.view.php";
?>
