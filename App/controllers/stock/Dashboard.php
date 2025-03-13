<?php
require "../App/models/UserGoal.php";

auth(); // Ensure user is authenticated

$userGoal = new GoalModel();
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    $_SESSION["flash"] = "You must be logged in to access the dashboard.";
    header("Location: /login");
    exit;
}

// ✅ Check if the user missed a required workout and reset streak if needed
$userGoal->resetStreakIfMissed($userId);

// ✅ Get the user's current streak
$streak = $userGoal->getStreak($userId);

$title = "Dashboard";
require "../App/views/tasks/dashboard.view.php";
?>
