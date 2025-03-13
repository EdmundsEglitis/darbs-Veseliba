<?php

require_once "../app/Core/Database.php";

class GoalModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Set a user's workout goal (which days they want to work out)
    public function setWorkoutGoal(int $userId, array $days) {
        $daysString = implode(',', $days); // Convert array to a string
        $query = $this->db->dbconn->prepare("INSERT INTO user_goals (user_id, workout_days) VALUES (:user_id, :workout_days)
            ON DUPLICATE KEY UPDATE workout_days = :workout_days");
        $query->execute([
            ':user_id' => $userId,
            ':workout_days' => $daysString,
        ]);

        return $query->rowCount() > 0;
    }

    // Get the user's workout goal
    public function getWorkoutGoal(int $userId) {
        $query = $this->db->dbconn->prepare("SELECT workout_days FROM user_goals WHERE user_id = :user_id");
        $query->execute([':user_id' => $userId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result ? explode(',', $result['workout_days']) : [];
    }

    // Log a completed workout
    public function logWorkout(int $userId, string $date) {
        $query = $this->db->dbconn->prepare("INSERT INTO workout_logs (user_id, workout_date) VALUES (:user_id, :workout_date)");
        $query->execute([
            ':user_id' => $userId,
            ':workout_date' => $date,
        ]);

        return $query->rowCount() > 0;
    }

    // Check if the user logged a workout on a specific day
    public function didUserWorkout(int $userId, string $date) {
        $query = $this->db->dbconn->prepare("SELECT COUNT(*) as count FROM workout_logs WHERE user_id = :user_id AND workout_date = :workout_date");
        $query->execute([
            ':user_id' => $userId,
            ':workout_date' => $date,
        ]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result && $result['count'] > 0;
    }

    // Calculate the user's streak
    public function getWorkoutStreak(int $userId) {
        $query = $this->db->dbconn->prepare("
            SELECT workout_date 
            FROM workout_logs 
            WHERE user_id = :user_id 
            ORDER BY workout_date DESC");
        $query->execute([':user_id' => $userId]);
        $workouts = $query->fetchAll(PDO::FETCH_COLUMN);

        $streak = 0;
        $currentDate = new DateTime();
        foreach ($workouts as $workoutDate) {
            $workoutDateObj = new DateTime($workoutDate);
            $interval = $currentDate->diff($workoutDateObj)->days;

            if ($interval == $streak) {
                $streak++;
            } else {
                break;
            }
        }

        return $streak;
    }
    public function resetStreakIfMissed($userId) {
        // Check if the user missed a scheduled workout day without logging a workout
        $query = $this->db->dbconn->prepare("
            SELECT COUNT(*) as missed_days
            FROM user_goals
            WHERE user_id = :user_id
            AND FIND_IN_SET(DAYNAME(CURDATE()), workout_days) > 0
            AND NOT EXISTS (
                SELECT 1 FROM workout_logs 
                WHERE workout_logs.user_id = user_goals.user_id 
                AND workout_logs.workout_date = CURDATE()
            )
        ");
        $query->execute([':user_id' => $userId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        if ($result['missed_days'] > 0) {
            // Reset the user's streak if they missed a scheduled workout
            $resetQuery = $this->db->dbconn->prepare("
                UPDATE users SET streak = 0 WHERE id = :user_id
            ");
            $resetQuery->execute([':user_id' => $userId]);
        }
    }


    // ✅ Get current streak
    public function getStreak($userId) {
        $query = $this->db->dbconn->prepare("SELECT streak FROM users WHERE user_id = :user_id");
        $query->execute([':user_id' => $userId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['streak'] : 0;
    }

    // Reset the user's streak if they miss a required workout day
    public function resetStreak(int $userId) {
        $query = $this->db->dbconn->prepare("DELETE FROM workout_logs WHERE user_id = :user_id");
        $query->execute([':user_id' => $userId]);
        return $query->rowCount() > 0;
    }
}

?>
