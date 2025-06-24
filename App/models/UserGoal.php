<?php

require_once "../app/Core/Database.php";

class GoalModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Set a user's workout goal (which days they want to work out)
    public function getWorkoutGoal($userId) {
        $stmt = $this->db->prepare("SELECT workout_days FROM user_goals WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function setWorkoutGoal($userId, $workoutDays) {
        $goalDays = implode(",", $workoutDays);
    
        // Check if goal already exists
        $stmt = $this->db->prepare("SELECT id FROM user_goals WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $userId);
        $stmt->execute();
    
        if ($stmt->fetch()) {
            // ✅ UPDATE existing goal
            $updateStmt = $this->db->prepare("UPDATE user_goals SET workout_days = :workout_days WHERE user_id = :user_id");
            $updateStmt->bindParam(":workout_days", $goalDays);
            $updateStmt->bindParam(":user_id", $userId);
            return $updateStmt->execute();
        } else {
            // ✅ INSERT new goal
            $insertStmt = $this->db->prepare("INSERT INTO user_goals (user_id, workout_days) VALUES (:user_id, :workout_days)");
            $insertStmt->bindParam(":user_id", $userId);
            $insertStmt->bindParam(":workout_days", $goalDays);
            return $insertStmt->execute();
        }
    }
    
    
    



    public function isWorkoutDay($userId) {
        $query = "SELECT workout_days FROM user_goals WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_id", $userId);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) return false;
    
        $workoutDays = explode(",", $result["workout_days"]); // Convert string to array
        $today = date("l"); // Get today's day name (e.g., "Monday")
    
        return in_array($today, $workoutDays);
    }
    
    public function logWorkout($userId) {
        if (!$this->isWorkoutDay($userId)) {
            return false; // Not a valid workout day
        }
    
        // Check if workout already logged today
        $query = "SELECT COUNT(*) FROM workout_logs WHERE user_id = :user_id AND date = CURDATE()";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_id", $userId);
        $stmt->execute();
        
        if ($stmt->fetchColumn() > 0) {
            return false; // Workout already logged today
        }
    
        // Log workout
        $query = "INSERT INTO workout_logs (user_id, date) VALUES (:user_id, CURDATE())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_id", $userId);
        $stmt->execute();
    
        // Increase streak
        $query = "UPDATE users SET streak = streak + 1 WHERE id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_id", $userId);
        return $stmt->execute();
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
    // Get user's goal days
    $stmt = $this->db->dbconn->prepare("SELECT workout_days FROM user_goals WHERE user_id = :user_id");
    $stmt->execute([':user_id' => $userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result || empty($result['workout_days'])) {
        echo "ℹ️ No workout goal found or no workout days set.<br>";
        return;
    }

    $workoutDays = explode(",", $result['workout_days']);
    $yesterday = (new DateTime('yesterday'))->format('l');
    $yesterdayDate = (new DateTime('yesterday'))->format('Y-m-d');

    

    if (!in_array($yesterday, $workoutDays)) {
        echo "ℹ️ Yesterday was not a scheduled workout day.<br>";
        return; // Nothing to reset
    }

    // Did the user log a workout yesterday?
    $stmt = $this->db->dbconn->prepare("
        SELECT COUNT(*) FROM workout_logs
        WHERE user_id = :user_id AND workout_date = :workout_date
    ");
    $stmt->execute([
        ':user_id' => $userId,
        ':workout_date' => $yesterdayDate
    ]);
    $count = $stmt->fetchColumn();

    

    if ($count == 0) {
        $stmt = $this->db->dbconn->prepare("UPDATE users SET streak = 0 WHERE user_id = :user_id");
        if ($stmt->execute([':user_id' => $userId])) {
            
        } else {
            
        }
    } else {
        
    }
}

    
    


    // ✅ Get current streak
public function getStreak($userId) {
    $query = $this->db->dbconn->prepare("SELECT streak FROM users WHERE user_id = :user_id");
    $query->execute([':user_id' => $userId]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo "❌ No user found with that ID.<br>";
    }
    return $result ? $result['streak'] : 0;
}

    

    // Reset the user's streak if they miss a required workout day
    public function resetStreak(int $userId) {
        $query = $this->db->dbconn->prepare("DELETE FROM workout_logs WHERE user_id = :user_id");
        $query->execute([':user_id' => $userId]);
        return $query->rowCount() > 0;
    }
    
    public function getUserWorkouts($userId) {
        $query = "SELECT user_id, title, workout_id FROM WorkoutPlans WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":user_id", $userId);
        $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getWorkoutById($userId, $workoutId) {
        $query = "SELECT title FROM WorkoutPlans WHERE workout_id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $workoutId, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
  public function logWorkoutWithName($userId, $workoutName) {
    // ✅ Check if today is a scheduled workout day
    $goalQuery = $this->db->prepare("SELECT workout_days FROM user_goals WHERE user_id = :user_id");
    $goalQuery->bindParam(":user_id", $userId);
    $goalQuery->execute();
    $goal = $goalQuery->fetch(PDO::FETCH_ASSOC);

    if (!$goal) {
        echo "❌ No workout goal set.<br>";
        return false;
    }

    $workoutDays = explode(",", $goal['workout_days']);
    $today = date('l');

    if (!in_array($today, $workoutDays)) {
        echo "❌ Today is not a scheduled workout day.<br>";
        return false;
    }

    // ✅ Check if workout already logged today
    $checkQuery = $this->db->prepare("
        SELECT COUNT(*) FROM workout_logs
        WHERE user_id = :user_id AND workout_date = CURDATE()
    ");
    $checkQuery->bindParam(":user_id", $userId);
    $checkQuery->execute();

    if ($checkQuery->fetchColumn() > 0) {
        echo "❌ Workout already logged today. Streak will not increment.<br>";
        return false;
    }

    // ✅ Log the workout
    $logQuery = $this->db->prepare("
        INSERT INTO workout_logs (user_id, workout_date, workout_name)
        VALUES (:user_id, CURDATE(), :workout_name)
    ");
    $logQuery->bindParam(":user_id", $userId);
    $logQuery->bindParam(":workout_name", $workoutName);

    if ($logQuery->execute()) {
        // ✅ Increment streak
        $streakQuery = $this->db->prepare("
            UPDATE users SET streak = streak + 1 WHERE user_id = :user_id
        ");
        $streakQuery->bindParam(":user_id", $userId);

        if ($streakQuery->execute()) {
            echo "✅ Workout logged and streak incremented.<br>";
            return true;
        } else {
            echo "❌ Workout logged but failed to increment streak.<br>";
        }
    } else {
        echo "❌ Failed to log workout.<br>";
    }

    return false;
}


    
    
    
    
    
}

?>
