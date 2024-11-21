<?php
require "../App/models/WorkoutPlan.php";

auth(); // Ensure the user is authenticated

$workoutPlan = new WorkoutPlan();

// Validate and parse the workout ID from the query string
$workoutId = isset($_GET['plan_id']) ? intval($_GET['plan_id']) : null;


// Fetch exercises for the specific workout plan
$exercises = $workoutPlan->getExercises($workoutId);
$exercises = $workoutPlan->getExercises($workoutId);
$title = "View Workout Exercises";
require "../App/views/tasks/ViewWorkout.view.php";
