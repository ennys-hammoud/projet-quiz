<?php
require_once 'classes/Quiz.php'; // Pour la classe Quiz
require_once 'classes/Answers.php'; // Pour la classe Answer
require_once 'classes/Question.php'; // Pour la classe Question
require_once 'classes/User.php'; // Pour la classe User

$db = new Database();
$pdo = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $quiz_id = $_POST['quiz_id'];
    $user_answers = $_POST['reponse'] ?? [];

    // Vérifier que le quiz existe
    $stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id = ?");
    $stmt->execute([$quiz_id]);
    $quiz = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$quiz) {
        die("Quiz introuvable.");
    }

    // Vérifier si l'utilisateur a répondu
    if (empty($user_answers)) {
        die("Aucune réponse soumise. Veuillez répondre aux questions.");
    }

    // Initialisation du score
    $score = 0;
    $total_questions = count($user_answers);

    // Vérification des réponses
    foreach ($user_answers as $question_id => $answer_id) {
        // Requête pour vérifier si la réponse est correcte
        $query = $pdo->prepare("SELECT is_correct FROM answers WHERE id = ? AND question_id = ?");
        $query->execute([$answer_id, $question_id]);
        $answer = $query->fetch(PDO::FETCH_ASSOC);

        if ($answer && $answer['is_correct'] == 1) {
            $score++;
        }
    }

    // Calcul du pourcentage de réussite
    $score_percent = ($total_questions > 0) ? ($score / $total_questions) * 100 : 0;

    // Affichage du résultat
    echo "<h1>Résultat du Quiz</h1>";
    echo "<p>Votre score : $score / $total_questions ($score_percent%)</p>";
    echo "<a href='index.php'>Retour à l'accueil</a>";
}
?>