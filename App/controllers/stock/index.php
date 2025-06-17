<?php
require_once "../App/models/UserGoal.php";

auth();

$userId = $_SESSION['user_id'];
$goalModel = new GoalModel();

if (!$userId) {
    echo "❌ No user ID found in session.";
    exit;
}

try {
    // ✅ Check + reset streak if missed
    $goalModel->resetStreakIfMissed($userId);
    echo "✅ resetStreakIfMissed executed<br>";

    // ✅ Get current streak
    $streak = $goalModel->getStreak($userId);
    echo "✅ Current streak: $streak<br>";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
    exit;
}

$title = "Home Page";

require "../App/views/tasks/index.view.php";
?>
