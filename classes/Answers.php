<?php
require_once __DIR__ . '/../Config/Database.php';

class Answer {
    private $pdo;

    public function __construct(Database $db) {
        $this->pdo = $db->getConnection();
    }

    // Ajouter une réponse à une question
        public function addAnswers($question_id, $answer_text, $is_correct) {
        try {
            $query = "INSERT INTO answers (question_id, answer_text, is_correct) VALUES (:question_id, :answer_text, :is_correct)";
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute([
                ':question_id' => $question_id,
                ':answer_text' => $answer_text,
                ':is_correct' => $is_correct
            ]);
        } catch (PDOException $e) {
            // Gérer l'erreur ici (journalisation, message utilisateur, etc.)
            return false;
        }
    }

    public function deleteAnswer($id) {
        $query = "DELETE FROM answers WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    // Récupérer toutes les réponses pour une question
    public function getAnswersByQuestionId($question_id) {
        $query = "SELECT * FROM answers WHERE question_id = :question_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':question_id' => $question_id]);
        return $stmt->fetchAll();
    }
}
?>