<?php
require_once 'classes/Quiz.php'; // Pour la classe Quiz
require_once 'classes/Answers.php'; // Pour la classe Answer
require_once 'classes/Question.php'; // Pour la classe Question
require_once 'classes/User.php'; // Pour la classe User

$db = new Database();

try {
    // Tenter de se connecter à la base de données
    $pdo = $db->getConnection();
    echo "Connexion à la base de données réussie !";
} catch (PDOException $e) {
    // Si la connexion échoue, afficher un message d'erreur
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>