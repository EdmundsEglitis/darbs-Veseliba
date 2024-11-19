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

    /**
     * Get all workout plans for a user
     *
     * @param int $userId
     * @return array
     */
    public function getUserPlans(int $userId): array {
        $query = $this->db->dbconn->prepare(
            "SELECT workout_id, title, created_at FROM WorkoutPlans WHERE user_id = :user_id ORDER BY created_at DESC"
        );
        $query->execute([':user_id' => $userId]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
