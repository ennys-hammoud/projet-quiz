<?php
require_once 'Database.php';

class Quiz {
    private $pdo;

    public function __construct(Database $db) {
        $this->pdo = $db->getConnection();
    }

    // Ajouter un quiz
    public function addQuiz($title, $category) {
        $query = "INSERT INTO quizzes (title, category) VALUES (:title, :category)";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ':title' => $title,
            ':category' => $category
        ]);
    }

    // Récupérer tous les quiz
    public function getAllQuizzes() {
        $query = "SELECT * FROM quizzes";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }

    // Récupérer un quiz par son ID
    public function getQuizById($id) {
        $query = "SELECT * FROM quizzes WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Modifier un quiz
    public function updateQuiz($id, $title, $category) {
        $query = "UPDATE quizzes SET title = :title, category = :category WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':category' => $category
        ]);
    }

    // Supprimer un quiz
    public function deleteQuiz($id) {
        $query = "DELETE FROM quizzes WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>