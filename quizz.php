<?php
require_once 'classes/Quiz.php';

$quiz = new Quiz();
$tables_valides = $quiz->getQuizzes();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Quiz - Accueil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="logo">Projet Quiz</div>
        <nav>
            <ul>
                
                <li><a href="connexion.php">Connexion</a></li>
                
            </ul>
        </nav>
    </header>

    <!-- SECTION D'ACCUEIL -->
    <section class="hero">
        <div class="hero-content">
            <h1>Bienvenue sur</h1>
            <img src="quizz.png" alt="Logo Quiz" height="400" width="400">
            <p>Testez vos connaissances sur divers thèmes !</p>
        </div>
    </section>

    <main>
        <div class="quiz-container">
            <?php foreach ($tables_valides as $table) : ?>
                <div class="quiz-card">
                    <h2><?= ucfirst($table) ?></h2>
                    <p>Testez vos connaissances sur <?= ucfirst($table) ?> !</p>
                    <a href="quiz.php?id=<?= $table ?>" class="btn">Commencer</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2025 Quizz'APP - Tous droits réservés.</p>
    </footer>

</body>
</html>
