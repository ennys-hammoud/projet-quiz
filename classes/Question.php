<?php
require_once 'Database.php';

class Question {
    private $pdo;

    public function __construct(Database $db) {
        $this->pdo = $db->getConnection();
    }

    // Ajouter une question à un quiz
    public function addQuestion($quiz_id, $question_text) {
        try {
            $query = "INSERT INTO questions (quiz_id, question_text) VALUES (:quiz_id, :question_text)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':quiz_id' => $quiz_id,
                ':question_text' => $question_text
            ]);
            return true; // Succès de l'ajout
        } catch (PDOException $e) {
            // Gestion de l'erreur
            echo "Erreur lors de l'ajout de la question : " . $e->getMessage();
            return false; // Échec de l'ajout
        }
    }

    // Récupérer toutes les questions d'un quiz
    public function getQuestionsByQuizId($quiz_id) {
        try {
            $query = "SELECT * FROM questions WHERE quiz_id = :quiz_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':quiz_id' => $quiz_id]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Gestion de l'erreur
            echo "Erreur lors de la récupération des questions : " . $e->getMessage();
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }
}
?>