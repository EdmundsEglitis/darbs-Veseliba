<?php

require_once "../app/Core/Database.php";

class quizModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createQuiz(string $Title, string $description) {
        $Title = htmlspecialchars($Title);
        $description = htmlspecialchars($description);

        $query = $this->db->dbconn->prepare("INSERT INTO quizzes (Title, description) VALUES (:Title, :description)");
        $query->execute([
            ':Title' => $Title,
            ':description' => $description,
        ]);

        return $query->rowCount() > 0;
    }

    public function getAllQuizzes() {
        $query = $this->db->dbconn->prepare("SELECT * FROM quizzes");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastInsertId(string $Title, string $description) {
        $query = $this->db->dbconn->prepare("SELECT quiz_id FROM quizzes WHERE title = :Title AND description = :description");
        $query->execute([
            ':Title' => $Title,
            ':description' => $description,
        ]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['quiz_id'] : null;
    }
    public function createQuestion(string $Text, string $quiz_id) {
        $query = $this->db->dbconn->prepare("INSERT INTO questions (Text, quiz_id) VALUES (:Text, :quiz_id)");
        $query->execute([
            ':quiz_id' => $quiz_id,
            ':Text' => $Text,
        ]);
        return $query->rowCount() > 0;
    }
    public function getLastQuestionId($quizId, $questionText) {
        $query = $this->db->dbconn->prepare("SELECT question_id FROM questions WHERE quiz_id = :quiz_id AND Text = :text ORDER BY question_id DESC LIMIT 1");
        $query->execute([
            ':quiz_id' => $quizId,
            ':text' => $questionText,
        ]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['question_id'] : null;
    }
    


    

    public function createOption(string $correct, string $option1, string $option2, string $option3, string $option4, $question_id) {
        $query = $this->db->dbconn->prepare("INSERT INTO options (question_id, option_text1, option_text2, option_text3, option_text4, is_correct) VALUES (:question_id, :option1,:option2,:option3,:option4, :correct)");
        $query->execute([
            ':question_id' => $question_id,
            ':option1' => $option1,
            ':option2' => $option2,
            ':option3' => $option3, 
            ':option4' => $option4,
            ':correct' => $correct,
        ]);
        return $query->rowCount() > 0;
    }


    public function getAllQuizQuestions(string $quiz_id) {
        $query = $this->db->dbconn->prepare("SELECT text, question_id FROM questions WHERE quiz_id = :quiz_id");
        $query->execute([':quiz_id' => $quiz_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function quizOptions(string $question_id) {
        $query = $this->db->dbconn->prepare("SELECT option_text1, option_text2, option_text3, option_text4 FROM options WHERE question_id = :question_id");
        $query->execute([':question_id' => $question_id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function quizCorrect(string $question_id){
        $query = $this->db->dbconn->prepare("SELECT is_correct FROM options WHERE question_id = :question_id");
        $query->execute([
            ':question_id' => $question_id,

        ]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>
