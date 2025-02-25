<?php
require_once __DIR__ . '/../Config/Database.php';

class Question {
    private $pdo;

    public function __construct(Database $db) {
        $this->pdo = $db->getConnection();
    }

    public function addQuestion($quiz_id, $question_text) {
        try {
            $query = "INSERT INTO questions (quiz_id, question_text) VALUES (:quiz_id, :question_text)";
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute([
                ':quiz_id' => $quiz_id,
                ':question_text' => $question_text
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la question : " . $e->getMessage();
            return false;
        }
    }

    public function getQuestionsByQuizId($quiz_id) {
        try {
            $query = "SELECT * FROM questions WHERE quiz_id = :quiz_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':quiz_id' => $quiz_id]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des questions : " . $e->getMessage();
            return [];
        }
    }

    public function getQuestionById($id) {
        try {
            $query = "SELECT * FROM questions WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de la question : " . $e->getMessage();
            return false;
        }
    }

    public function updateQuestion($id, $question_text) {
        try {
            $query = "UPDATE questions SET question_text = :question_text WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute([
                ':id' => $id,
                ':question_text' => $question_text
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour de la question : " . $e->getMessage();
            return false;
        }
    }

    public function deleteQuestion($id) {
        try {
            $query = "DELETE FROM questions WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la question : " . $e->getMessage();
            return false;
        }
    }

    public function countQuestionsByQuizId($quiz_id) {
        try {
            $query = "SELECT COUNT(*) as total FROM questions WHERE quiz_id = :quiz_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':quiz_id' => $quiz_id]);
            $result = $stmt->fetch();
            return $result['total'];
        } catch (PDOException $e) {
            echo "Erreur lors du comptage des questions : " . $e->getMessage();
            return 0;
        }
    }
}
?>