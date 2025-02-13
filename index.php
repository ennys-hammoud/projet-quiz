<?php
session_start();

require_once 'classes/Database.php';
require_once 'classes/Quiz.php';

$db = new Database();
$pdo = $db->getConnection();

// Récupérer tous les quiz
$query = $pdo->prepare("SELECT * FROM quizzes");
$query->execute();
$quizzes = $query->fetchAll(PDO::FETCH_ASSOC);

$title = "Liste des Quiz";
require 'header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Quiz App' ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Quizz'APP</h1>
</header>

<!-- SECTION D'ACCUEIL -->
<section class="hero">
    <div class="hero-content">
        <h1>Bienvenue sur</h1><img src="quizz (1).png" alt="Logo Quiz" height="400" width="400">
        <p>Testez vos connaissances sur divers thèmes !</p>
    </div>
</section>

<!-- LISTE DES QUIZ -->
<div class="quiz-container">
    <?php foreach ($quizzes as $quiz): ?>
        <div class="quiz-card">
            <h2><?= htmlspecialchars($quiz['title']) ?></h2>
            <p>Catégorie: <?= htmlspecialchars($quiz['category']) ?></p>
            <a href="quiz.php?quiz_id=<?= $quiz['id'] ?>" class="btn">Commencer le quiz</a>
        </div>
    <?php endforeach; ?>
</div>

<?php require 'footer.php'; ?>