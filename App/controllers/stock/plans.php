<?php
require "../App/models/WorkoutPlan.php";

auth(); // Ensure the user is authenticated

$workoutPlan = new WorkoutPlan();
$userPlans = $workoutPlan->getUserPlans($_SESSION["user_id"]); // Fetch plans for logged-in user

$title = "Your Workout Plans";
require "../App/views/tasks/ViewPlans.view.php";
