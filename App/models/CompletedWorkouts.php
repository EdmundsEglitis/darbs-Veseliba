<?php
require "../App/Core/Database.php";

class CompletedWorkouts {
    private $db;
    private array $config;

    public function __construct() {
        $this->db = new Database(); // assuming Database is a class that returns a PDO instance
    }

    public function getLogedWorkouts($userId) {
        $query = "SELECT workout_date, workout_name FROM workout_logs WHERE user_id = :user_id";
        
        $stmt = $this->db->prepare($query); // prepare the query using the db connection
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll to return multiple results
    }    
}
