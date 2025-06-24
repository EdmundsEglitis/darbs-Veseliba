<?php
require_once "../App/models/UserGoal.php";

auth();

$userId = $_SESSION['user_id'];
$goalModel = new GoalModel();

if (!$userId) {

    exit;
}

try {
    // ✅ Check + reset streak if missed
    $goalModel->resetStreakIfMissed($userId);


    // ✅ Get current streak
    $streak = $goalModel->getStreak($userId);

} catch (Exception $e) {
    exit;
}

$title = "Home Page";

require "../App/views/tasks/index.view.php";
?>
