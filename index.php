<?php
session_start(); // Démarrage de la session

require_once 'classes/Database.php';  // Pour la connexion à la base de données
require_once 'classes/Quiz.php';     // Pour la classe Quiz

$db = new Database();
$pdo = $db->getConnection();

// Récupérer tous les quiz
$query = $pdo->prepare("SELECT * FROM quizzes");
$query->execute();
$quizzes = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .quiz-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .quiz-card {
            width: 45%;
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .quiz-card h2 {
            font-size: 1.5em;
        }
        .quiz-card a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .quiz-card a:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Liste des Quiz</h1>

    <div class="quiz-container">
        <?php foreach ($quizzes as $quiz): ?>
            <div class="quiz-card">
                <h2><?= htmlspecialchars($quiz['title']) ?></h2>
                <p>Catégorie: <?= htmlspecialchars($quiz['category']) ?></p>
                <a href="quiz.php?quiz_id=<?= $quiz['id'] ?>">Commencer le quiz</a>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>