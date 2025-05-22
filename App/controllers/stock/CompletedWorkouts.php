<?php
require "../App/models/CompletedWorkouts.php";

auth(); 

$CompletedWorkouts= new CompletedWorkouts();
$userWorkouts = $CompletedWorkouts->getLogedWorkouts($_SESSION["user_id"]); // Fetch plans for logged-in user

$title = "Your Workout Plans";
require "../App/views/tasks/CompletedWorkouts.view.php";
