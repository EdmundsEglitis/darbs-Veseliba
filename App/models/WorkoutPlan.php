<?php
require "../App/Core/Database.php";

class WorkoutPlan {
    private $db;
    private array $config;

    public function __construct() {
        $this->config = require("../App/config.php");
        $this->db = new Database($this->config);
    }

    public function createWorkout(int $userId, string $title): bool {
        $title = htmlspecialchars($title);

        $query = $this->db->dbconn->prepare(
            "INSERT INTO WorkoutPlans (user_id, title) VALUES (:user_id, :title)"
        );

        $query->execute([
            ':user_id' => $userId,
            ':title' => $title,
        ]);

        return $query->rowCount() > 0;
    }

    public function getUserPlans(int $userId): array {
        $query = $this->db->dbconn->prepare(
            "SELECT workout_id, title, created_at FROM WorkoutPlans WHERE user_id = :user_id ORDER BY created_at DESC"
        );
        $query->execute([':user_id' => $userId]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add an exercise to a workout plan
     *
     * @param int $workoutId
     * @param string $exerciseName
     * @param string $description
     * @param string|null $photoUrl
     * @return bool
     */
    public function addExercise(int $workoutId, string $exerciseName, string $description, ?string $photoUrl = null): bool {
        $exerciseName = htmlspecialchars($exerciseName);
        $description = htmlspecialchars($description);

        $query = $this->db->dbconn->prepare(
            "INSERT INTO Exercises (workout_id, exercise_name, description, photo_url) 
             VALUES (:workout_id, :exercise_name, :description, :photo_url)"
        );

        $query->execute([
            ':workout_id' => $workoutId,
            ':exercise_name' => $exerciseName,
            ':description' => $description,
            ':photo_url' => $photoUrl,
        ]);

        return $query->rowCount() > 0;
    }

    /**
     * Get exercises for a workout plan
     *
     * @param int $workoutId
     * @return array
     */
    public function getExercises(int $workoutId): array {
        $query = $this->db->dbconn->prepare(
            "SELECT exercise_id, exercise_name, description, photo_url 
             FROM Exercises 
             WHERE workout_id = :workout_id ORDER BY exercise_id ASC"
        );
        $query->execute([':workout_id' => $workoutId]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function doesWorkoutExist(int $workoutId): bool {
        $query = $this->db->dbconn->prepare("SELECT COUNT(*) FROM WorkoutPlans WHERE workout_id = :workout_id");
        $query->execute([':workout_id' => $workoutId]);
        return $query->fetchColumn() > 0;
    }
    
    
}
