<?php
require "../App/models/CompletedWorkouts.php";
auth();

if (isset($_GET['id'])) {
    $CompletedWorkouts = new CompletedWorkouts();
    $CompletedWorkouts->deleteWorkout($_GET['id'], $_SESSION['user_id']);
}

header("Location: /completedWorkouts");
exit;
