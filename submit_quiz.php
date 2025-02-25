<?php
require_once 'classes/Quiz.php';
require_once 'classes/Answers.php';
require_once 'classes/Question.php';
require_once 'classes/User.php';

$db = new Database();
$pdo = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $quiz_id = $_POST['quiz_id'];
    $user_answers = $_POST['reponse'] ?? [];

    $stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id = ?");
    $stmt->execute([$quiz_id]);
    $quiz = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$quiz) {
        die("Quiz introuvable.");
    }

    if (empty($user_answers)) {
        die("Aucune réponse soumise. Veuillez répondre aux questions.");
    }

    $score = 0;
    $total_questions = count($user_answers);

    $feedback = [];

    foreach ($user_answers as $question_id => $answer_id) {
        $query = $pdo->prepare("SELECT * FROM answers WHERE question_id = ?");
        $query->execute([$question_id]);
        $answers = $query->fetchAll(PDO::FETCH_ASSOC);

        $correct_answer_text = null;
        $user_answer_text = null;
        $is_correct = false;

        foreach ($answers as $answer) {
            if ($answer['id'] == $answer_id) {
                $user_answer_text = $answer['answer_text'];
                if ($answer['is_correct']) {
                    $is_correct = true;
                    $score++;
                }
            }
            if ($answer['is_correct']) {
                $correct_answer_text = $answer['answer_text'];
            }
        }

        $feedback[] = [
            'question_id' => $question_id,
            'user_answer_text' => $user_answer_text,
            'correct_answer_text' => $correct_answer_text,
            'is_correct' => $is_correct
        ];
    }

    $score_percent = ($total_questions > 0) ? ($score / $total_questions) * 100 : 0;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="submit.css">
    <title>Résultats du Quiz</title>
</head>
<body>
    <h1>Résultats du Quiz : <?= htmlspecialchars($quiz['title']) ?></h1>
    <p>Votre score : <?= $score ?> / <?= $total_questions ?> (<?= number_format($score_percent, 2) ?>%)</p>

    <h2>Détails des réponses :</h2>
    <ul>
        <?php foreach ($feedback as $result): ?>
            <li>
                Question ID <?= $result['question_id'] ?> :
                <strong>Votre réponse :</strong> <?= htmlspecialchars($result['user_answer_text']) ?>
                <?php if (!$result['is_correct']): ?>
                    <span style="color: red;">(Faux)</span>
                    <br><strong>Bonne réponse :</strong> <?= htmlspecialchars($result['correct_answer_text']) ?>
                <?php else: ?>
                    <span style="color: green;">(Correct)</span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="index.php">Retour à l'accueil</a>
</body>
</html>