<?php
require_once __DIR__ . '/../Config/Database.php';
class Quiz {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getQuizById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM quizzes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateQuiz($id, $title, $category) {
        $stmt = $this->pdo->prepare("UPDATE quizzes SET title = ?, category = ? WHERE id = ?");
        $stmt->execute([$title, $category, $id]);
    }

    public function getQuestions($quiz_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM questions WHERE quiz_id = ?");
        $stmt->execute([$quiz_id]);
        return $stmt->fetchAll();
    }

    public function addQuestion($quiz_id, $question_text) {
        $stmt = $this->pdo->prepare("INSERT INTO questions (quiz_id, question_text) VALUES (?, ?)");
        $stmt->execute([$quiz_id, $question_text]);
    }

    public function deleteQuestion($question_id) {
        $stmt = $this->pdo->prepare("DELETE FROM questions WHERE id = ?");
        $stmt->execute([$question_id]);
    }

    public function getAnswers($question_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM answers WHERE question_id = ?");
        $stmt->execute([$question_id]);
        return $stmt->fetchAll();
    }

    public function addAnswer($question_id, $answer_text) {
        $stmt = $this->pdo->prepare("INSERT INTO answers (question_id, answer_text) VALUES (?, ?)");
        $stmt->execute([$question_id, $answer_text]);
    }

    public function deleteAnswer($answer_id) {
        $stmt = $this->pdo->prepare("DELETE FROM answers WHERE id = ?");
        $stmt->execute([$answer_id]);
    }
}
?>