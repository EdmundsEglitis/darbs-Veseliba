<?php
require "../App/models/CompletedWorkouts.php";
auth(); 

$CompletedWorkouts = new CompletedWorkouts();

$sort = $_GET['sort'] ?? null;
$keyword = $_GET['keyword'] ?? null;

$userWorkouts = $CompletedWorkouts->getLoggedWorkouts($_SESSION["user_id"], $sort, $keyword);

$title = "Your Workout Plans";
require "../App/views/tasks/CompletedWorkouts.view.php";
