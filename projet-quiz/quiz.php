<?php
require 'config.php'; // Connexion à la base de données
$quiz_id = isset($_GET['quiz_id']) ? (int)$_GET['quiz_id'] : 1; // Récupère le quiz_id de l'URL, sinon par défaut 1

// Vérifier si le quiz existe
$query = $pdo->prepare("SELECT * FROM quizzes WHERE id = ?");
$query->execute([$quiz_id]);
$quiz = $query->fetch(PDO::FETCH_ASSOC);

if (!$quiz) {
    die("Quiz introuvable !");
}

// Récupérer les questions du quiz
$query = $pdo->prepare("SELECT * FROM questions WHERE quiz_id = ?");
$query->execute([$quiz_id]);
$questions = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz : <?= htmlspecialchars($quiz['title']) ?></title>
</head>
<body>
    <h1>Quiz : <?= htmlspecialchars($quiz['title']) ?> (<?= htmlspecialchars($quiz['category']) ?>)</h1>

    <form action="submit.php" method="POST">
        <input type="hidden" name="quiz_id" value="<?= $quiz_id ?>">

        <?php foreach ($questions as $question): ?>
            <fieldset>
                <legend><?= htmlspecialchars($question['question_text']) ?></legend>
                <?php
                $query = $pdo->prepare("SELECT * FROM answers WHERE question_id = ?");
                $query->execute([$question['id']]);
                $answers = $query->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php foreach ($answers as $answer): ?>
                    <label>
                        <input type="radio" name="reponse[<?= $question['id'] ?>]" value="<?= $answer['id'] ?>" required>
                        <?= htmlspecialchars($answer['answer_text']) ?>
                    </label><br>
                <?php endforeach; ?>
            </fieldset>
        <?php endforeach; ?>

        <button type="submit">Valider</button>
    </form>

    <a href="index.php">Retour à l'accueil</a>
</body>
</html>