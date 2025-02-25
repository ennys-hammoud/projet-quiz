<?php
session_start();
require_once __DIR__ . '/Config/Database.php'; // Pour la connexion à la base de données
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

    // Vérification de la longueur du thème
    if (strlen($theme) > 255) {
        echo "<p class='message error'>Le thème est trop long. Maximum 255 caractères.</p>";
        exit;
    }

    // Vérification des caractères valides
    if (!preg_match("/^[a-zA-Z0-9\s]+$/", $theme)) {
        echo "<p class='message error'>Le thème contient des caractères invalides. Utilisez uniquement des lettres, des chiffres et des espaces.</p>";
        exit;
    }

    if (!empty($title) && !empty($theme)) {
        $stmt = $pdo->prepare("INSERT INTO quizzes (title, category) VALUES (?, ?)");
        $stmt->execute([$title, $theme]);
        echo "Quiz ajouté avec succès ! <a href='admin.php'>Retour</a>";
        echo "<p class='message success'>Quiz ajouté avec succès ! <a href='admin.php'>Retour</a></p>";
    } else {
        echo "Veuillez remplir tous les champs.";
        echo "<p class='message error'>Veuillez remplir tous les champs.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Quiz</title>
    <link rel="stylesheet" href="add_quiz.css">
</head>
<body>
    <header>
        <div class="logo">Admin Panel</div>
        <nav>
            <ul>
                <li><a href="admin.php">Retour</a></li>
            </ul>
        </nav>
    </header>

    <div class="add-quiz-section">
        <h1>Ajouter un Quiz</h1>
        <form method="post">
            <input type="text" name="title" placeholder="Titre du quiz" required>
            <input type="text" name="theme" placeholder="Thème (ex: football, cinéma, musique)" required>
            <button type="submit">Ajouter</button>
        </form>
    </div>

    <footer>
        © 2025 Projet Quiz. Tous droits réservés.
    </footer>
</body>
</html>