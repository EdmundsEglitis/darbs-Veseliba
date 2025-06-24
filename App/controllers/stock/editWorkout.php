<?php
require "../App/models/CompletedWorkouts.php";
auth();

$CompletedWorkouts = new CompletedWorkouts();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        header("Location: /completedWorkouts");
        exit;
    }

    $workout = $CompletedWorkouts->getWorkoutById($id, $_SESSION['user_id']);
    $title = "Edit Workout";
    require "../App/views/tasks/EditWorkout.view.php";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['workout_name'];
    $date = $_POST['workout_date'];

    $CompletedWorkouts->updateWorkout($id, $name, $date, $_SESSION['user_id']);
    header("Location: /completedWorkouts");
    exit;
}
