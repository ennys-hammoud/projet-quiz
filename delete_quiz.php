<?php
session_start();
require_once 'classes/Database.php';  // Pour la connexion à la base de données
require_once 'classes/Quiz.php';     // Pour la classe Quiz
require_once 'classes/Answers.php';   // Pour la classe Answer
require_once 'classes/Question.php'; // Pour la classe Question
require_once 'classes/User.php';     // Pour la classe User
$db = new Database();
$pdo = $db->getConnection();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Vérifier si un ID de quiz est passé en paramètre
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];

    // Vérifier si le quiz existe
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM quizzes WHERE id = ?");
    $stmt->execute([$id]);
    $quizExists = $stmt->fetchColumn();

    if ($quizExists) {
        // Suppression du quiz
        $stmt = $pdo->prepare("DELETE FROM quizzes WHERE id = ?");
        $stmt->execute([$id]);

        // Rediriger vers admin.php avec un message de succès
        header("Location: admin.php?message=Quiz supprimé avec succès.");
        exit;
    } else {
        echo "Quiz introuvable.";
        exit;
    }
} else {
    echo "ID invalide.";
    exit;
}
?>