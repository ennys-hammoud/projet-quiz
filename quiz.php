<?php
require_once 'classes/Quiz.php';

$quiz = new Quiz();

// Vérifier si un ID de quiz est passé dans l'URL
if (!isset($_GET['id'])) {
    die("Aucun quiz sélectionné.");
}

$quiz_id = htmlspecialchars($_GET['id']);

// Vérifier si la table du quiz existe
$tables_valides = $quiz->getQuizzes();
if (!in_array($quiz_id, $tables_valides)) {
    die("Quiz invalide.");
}

// Récupérer les questions du quiz
$questions = $quiz->getQuestions($quiz_id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - <?= ucfirst($quiz_id) ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <div class="logo">Projet Quiz</div>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                
            </ul>
        </nav>
    </header>

    <section class="quiz-section">
        <h1>Quiz : <?= ucfirst($quiz_id) ?></h1>

        <?php if (count($questions) > 0): ?>
            <form method="POST" action="">
                <?php foreach ($questions as $index => $q): ?>
                    <p><strong>Question <?= $index + 1 ?> :</strong> <?= htmlspecialchars($q['question']) ?></p>
                    <label for="reponse<?= $index ?>">Réponse :</label>
                    <?php
                    // Récupérer les propositions de réponses pour chaque question
                    $propositions = $quiz->getPropositions($quiz_id, $q['id']);
                    foreach ($propositions as $prop_index => $prop): ?>
                        <div>
                            <input type="radio" id="reponse<?= $index ?>_<?= $prop_index ?>" name="reponse<?= $index ?>" value="<?= htmlspecialchars($prop['proposition']) ?>">
                            <label for="reponse<?= $index ?>_<?= $prop_index ?>"><?= htmlspecialchars($prop['proposition']) ?></label>
                        </div>
                    <?php endforeach; ?>
                    <br>
                <?php endforeach; ?>
                <br>
                <input type="submit" value="Valider">
            </form>

            <?php
            // Vérifier les réponses soumises par l'utilisateur
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $correct = true;
                foreach ($questions as $index => $q) {
                    $user_reponse = htmlspecialchars($_POST["reponse$index"]);
                    if ($user_reponse !== $q['reponse']) {
                        $correct = false;
                        break;
                    }
                }
                if ($correct) {
                    echo "<p>Bonne réponse !</p>";
                } else {
                    echo "<p>Mauvaise réponse, essayez encore.</p>";
                }
            }
            ?>
        <?php else: ?>
            <p>Aucune question trouvée pour ce quiz.</p>
        <?php endif; ?>
    </section>

    <footer>
        <p>&copy; 2025 Quizz'APP - Tous droits réservés.</p>
    </footer>

</body>
</html>
