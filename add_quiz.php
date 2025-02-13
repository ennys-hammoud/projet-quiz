<?php
session_start();
require_once 'classes/Database.php';  // Pour la connexion à la base de données
require_once 'classes/Quiz.php';     // Pour la classe Quiz
require_once 'classes/Answers.php';   // Pour la classe Answer
require_once 'classes/Question.php'; // Pour la classe Question
require_once 'classes/User.php';     // Pour la classe User
$db = new Database();
$pdo = $db->getConnection();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $theme = trim($_POST["theme"]);

    if (!empty($title) && !empty($theme)) {
        $stmt = $pdo->prepare("INSERT INTO quizzes (title, category) VALUES (?, ?)");
        $stmt->execute([$title, $theme]);
        echo "Quiz ajouté avec succès ! <a href='admin.php'>Retour</a>";
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

<form method="post">
    <input type="text" name="title" placeholder="Titre du quiz" required>
    <input type="text" name="theme" placeholder="Thème (ex: football, cinéma, musique)" required>
    <button type="submit">Ajouter</button>
</form>