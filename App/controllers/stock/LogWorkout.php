<?php
require "../App/models/UserGoal.php";

auth(); // Ensure user is authenticated

$userGoal = new GoalModel();
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    $_SESSION["flash"] = "You must be logged in to log a workout.";
    header("Location: /login");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $workoutId = $_POST['workout_id'] ?? null;

    if (!$workoutId) {
        $_SESSION["flash"] = "Please select a workout.";
        header("Location: /dashboard");
        exit;
    }

    if ($userGoal->isWorkoutDay($userId)) {
        // Check if workout already logged today
        $query = "SELECT COUNT(*) FROM workout_logs WHERE user_id = :user_id AND date = CURDATE()";
        $stmt = $userGoal->db->prepare($query);
        $stmt->bindParam(":user_id", $userId);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            $_SESSION["flash"] = "Workout already logged today.";
        } else {
            // Log workout with selected workout plan
            $query = "INSERT INTO workout_logs (user_id, workout_id, date) VALUES (:user_id, :workout_id, CURDATE())";
            $stmt = $userGoal->db->prepare($query);
            $stmt->bindParam(":user_id", $userId);
            $stmt->bindParam(":workout_id", $workoutId);
            $stmt->execute();

            // Increase streak
            $query = "UPDATE users SET streak = streak + 1 WHERE id = :user_id";
            $stmt = $userGoal->db->prepare($query);
            $stmt->bindParam(":user_id", $userId);
            $stmt->execute();

            $_SESSION["flash"] = "Workout logged successfully! Streak increased.";
        }
    } else {
        $_SESSION["flash"] = "It's not your scheduled workout day!";
    }
}

header("Location: /history");
exit;
?>
