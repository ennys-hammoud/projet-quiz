<?php
require_once 'Database.php';

class Quiz {
    private $bdd;

    public function __construct() {
        $this->bdd = Database::getInstance()->getConnection();
        $this->createPropositionsTableIfNotExists();
    }

    private function createPropositionsTableIfNotExists() {
        $sql = "CREATE TABLE IF NOT EXISTS propositions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            quiz_id VARCHAR(255) NOT NULL,
            question_id INT NOT NULL,
            proposition TEXT NOT NULL
        )";
        $this->bdd->exec($sql);
    }

    public function getQuestions($quiz_id) {
        $stmt = $this->bdd->prepare("SELECT * FROM $quiz_id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPropositions($quiz_id, $question_id) {
        $stmt = $this->bdd->prepare("SELECT * FROM propositions WHERE quiz_id = :quiz_id AND question_id = :question_id");
        $stmt->execute(['quiz_id' => $quiz_id, 'question_id' => $question_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProposition($quiz_id, $question_id, $proposition) {
        $sql = "INSERT INTO propositions (quiz_id, question_id, proposition) VALUES (:quiz_id, :question_id, :proposition)";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['quiz_id' => $quiz_id, 'question_id' => $question_id, 'proposition' => $proposition]);
    }

    public function updateQuestion($quiz_id, $id, $question, $reponse) {
        $sql = "UPDATE $quiz_id SET question = :question, reponse = :reponse WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['question' => $question, 'reponse' => $reponse, 'id' => $id]);
    }

    public function deleteQuestion($quiz_id, $id) {
        $sql = "DELETE FROM $quiz_id WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function addQuestion($quiz_id, $question, $reponse) {
        $sql = "INSERT INTO $quiz_id (question, reponse) VALUES (:question, :reponse)";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['question' => $question, 'reponse' => $reponse]);
    }

    public function createQuiz($quiz_name) {
        // Vérifier si la table existe déjà
        $stmt = $this->bdd->prepare("SHOW TABLES LIKE :quiz_name");
        $stmt->execute(['quiz_name' => $quiz_name]);
        if ($stmt->rowCount() > 0) {
            throw new Exception("La table '$quiz_name' existe déjà.");
        }

        // Créer la table si elle n'existe pas
        $sql = "CREATE TABLE $quiz_name (
            id INT AUTO_INCREMENT PRIMARY KEY,
            question TEXT NOT NULL,
            reponse TEXT NOT NULL
        )";
        $this->bdd->exec($sql);
    }

    public function getQuizzes() {
        $stmt = $this->bdd->query("SHOW TABLES");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>
