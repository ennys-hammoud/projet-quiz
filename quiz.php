<?php
require_once 'Config/Database.php';
require_once 'classes/Answers.php'; // Pour la classe Answer
require_once 'classes/Question.php'; // Pour la classe Question
require_once 'classes/User.php'; // Pour la classe User

// Récupérer le quiz_id depuis l'URL (méthode GET)
if (!isset($_GET['quiz_id']) || !is_numeric($_GET['quiz_id'])) {
    die("Quiz non valide !");
}
$quiz_id = $_GET['quiz_id'];

$db = new Database();
$pdo = $db->getConnection();



try {
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
} catch (Exception $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="quiz.css">
    <title>Quiz : <?= htmlspecialchars($quiz['title']) ?></title>
</head>
<body>
    <h1>Quiz : <?= htmlspecialchars($quiz['title']) ?> (<?= htmlspecialchars($quiz['category']) ?>)</h1>

    <form action="submit_quiz.php" method="POST">
        <input type="hidden" name="quiz_id" value="<?= $quiz_id ?>">

        <?php foreach ($questions as $question): ?>
            <fieldset>
                <legend><?= htmlspecialchars($question['question_text']) ?></legend>
                <?php
                // Récupérer les réponses possibles pour chaque question
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