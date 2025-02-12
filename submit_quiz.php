<?php
require 'config.php'; // Connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $quiz_id = $_POST['quiz_id'];
    $user_answers = $_POST['reponse'] ?? [];

    if (empty($user_answers)) {
        die("Aucune réponse soumise. Veuillez répondre aux questions.");
    }

    $score = 0;
    $total_questions = count($user_answers);

    foreach ($user_answers as $question_id => $answer_id) {
        // Vérifier si la réponse est correcte
        $query = $pdo->prepare("SELECT is_correct FROM answers WHERE id = ? AND question_id = ?");
        $query->execute([$answer_id, $question_id]);
        $answer = $query->fetch(PDO::FETCH_ASSOC);

        if ($answer && $answer['is_correct'] == 1) { // Vérification stricte
            $score++;
        }
    }

    $score_percent = ($total_questions > 0) ? ($score / $total_questions) * 100 : 0;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat du Quiz</title>
</head>
<body>
    <h1>Résultat du Quiz</h1>
    <p>Votre score : <?= $score ?> / <?= $total_questions ?> (<?= round($score_percent) ?>%)</p>
    <a href="index.php">Retour à l'accueil</a>
</body>
</html>