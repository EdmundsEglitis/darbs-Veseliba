<?php
require "../App/Core/Database.php";

class CompletedWorkouts {
    private $db;
    private array $config;

    public function __construct() {
        $this->db = new Database(); // assuming Database is a class that returns a PDO instance
    }

public function getLoggedWorkouts($userId, $sort = null, $keyword = null) {
    $query = "SELECT id, workout_date, workout_name FROM workout_logs WHERE user_id = :user_id";
    $params = [':user_id' => $userId];

    if ($keyword) {
        $query .= " AND workout_name LIKE :keyword";
        $params[':keyword'] = '%' . $keyword . '%';
    }

    switch ($sort) {
        case 'date_asc':
            $query .= " ORDER BY workout_date ASC";
            break;
        case 'date_desc':
            $query .= " ORDER BY workout_date DESC";
            break;
        case 'name_asc':
            $query .= " ORDER BY workout_name ASC";
            break;
        case 'name_desc':
            $query .= " ORDER BY workout_name DESC";
            break;
        default:
            $query .= " ORDER BY workout_date DESC"; // default
    }

    $stmt = $this->db->prepare($query);

    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function deleteWorkout($id, $userId) {
    $query = "DELETE FROM workout_logs WHERE id = :id AND user_id = :user_id";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
    $stmt->execute();
}



public function updateWorkout($id, $name, $date, $userId) {
    $query = "UPDATE workout_logs SET workout_name = :name, workout_date = :date WHERE id = :id AND user_id = :user_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":date", $date);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
    $stmt->execute();
}
public function getWorkoutById($id, $userId) {
    $query = "SELECT id, workout_name, workout_date FROM workout_logs WHERE id = :id AND user_id = :user_id";
    
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}




}
