<?php
session_start();
require_once 'Config/Database.php';
require_once 'classes/Quiz.php';
require_once 'classes/Answers.php';
require_once 'classes/Question.php';
require_once 'classes/User.php';

$db = new Database();
$pdo = $db->getConnection();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Vérifier si un ID de quiz est passé en paramètre
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    echo "ID de quiz invalide.";
    exit;
}

$id = $_GET["id"];

// Récupérer les informations du quiz
$stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id = ?");
$stmt->execute([$id]);
$quiz = $stmt->fetch();

if (!$quiz) {
    echo "Quiz introuvable.";
    exit;
}

// Mettre à jour le quiz
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_quiz"])) {
    $title = trim($_POST["title"]);
    $category = trim($_POST["category"]);

    if (!empty($title) && !empty($category) && strlen($title) <= 100) {
        $stmt = $pdo->prepare("UPDATE quizzes SET title = ?, category = ? WHERE id = ?");
        $stmt->execute([$title, $category, $id]);
        header("Location: edit_quiz.php?id=$id&message=Quiz modifié avec succès.");
        exit;
    } else {
        echo "Veuillez remplir tous les champs correctement.";
    }
}

// Ajouter une question
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_question"])) {
    $question_text = trim($_POST["question_text"]);
    if (!empty($question_text)) {
        $stmt = $pdo->prepare("INSERT INTO questions (quiz_id, question_text) VALUES (?, ?)");
        $stmt->execute([$id, $question_text]);
        header("Location: edit_quiz.php?id=$id&message=Question ajoutée.");
        exit;
    }
}

// Supprimer une question
if (isset($_GET["delete_question"])) {
    $question_id = $_GET["delete_question"];
    $stmt = $pdo->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->execute([$question_id]);
    header("Location: edit_quiz.php?id=$id&message=Question supprimée.");
    exit;
}

// Récupérer les questions et leurs réponses
$stmt = $pdo->prepare("SELECT * FROM questions WHERE quiz_id = ?");
$stmt->execute([$id]);
$questions = $stmt->fetchAll();

// Ajouter une réponse
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_answer"])) {
    $question_id = $_POST["question_id"];
    $answer_text = trim($_POST["answer_text"]);
    if (!empty($answer_text)) {
        $stmt = $pdo->prepare("INSERT INTO answers (question_id, answer_text) VALUES (?, ?)");
        $stmt->execute([$question_id, $answer_text]);
        header("Location: edit_quiz.php?id=$id&message=Réponse ajoutée.");
        exit;
    }
}

// Supprimer une réponse
if (isset($_GET["delete_answer"])) {
    $answer_id = $_GET["delete_answer"];
    $stmt = $pdo->prepare("DELETE FROM answers WHERE id = ?");
    $stmt->execute([$answer_id]);
    header("Location: edit_quiz.php?id=$id&message=Réponse supprimée.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Quiz</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header>
    <h1>Modifier le Quiz</h1>
</header>

<div class="admin-section">
    <form method="post">
        <label for="title">Titre du quiz :</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($quiz['title']) ?>" required>

        <label for="category">Catégorie :</label>
        <input type="text" id="category" name="category" value="<?= htmlspecialchars($quiz['category']) ?>" required>

        <button type="submit" name="update_quiz" class="btn">Modifier</button>
    </form>

    <h2>Questions du Quiz</h2>
    <form method="post">
        <label for="question_text">Nouvelle question :</label>
        <input type="text" id="question_text" name="question_text" required>
        <button type="submit" name="add_question" class="btn">Ajouter Question</button>
    </form>

    <?php if (!empty($_GET['message'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>

    <?php foreach ($questions as $question): ?>
        <div class="question">
            <p><?= htmlspecialchars($question["question_text"]) ?> 
                <a href="edit_quiz.php?id=<?= $id ?>&delete_question=<?= $question['id'] ?>" onclick="return confirm('Supprimer cette question ?')">🗑️</a>
            </p>

            <form method="post">
                <input type="hidden" name="question_id" value="<?= $question['id'] ?>">
                <input type="text" name="answer_text" placeholder="Ajouter une réponse" required>
                <button type="submit" name="add_answer" class="btn">Ajouter Réponse</button>
            </form>

            <ul>
                <?php
                $stmt = $pdo->prepare("SELECT * FROM answers WHERE question_id = ?");
                $stmt->execute([$question["id"]]);
                $answers = $stmt->fetchAll();
                foreach ($answers as $answer): ?>
                    <li><?= htmlspecialchars($answer["answer_text"]) ?> 
                        <a href="edit_quiz.php?id=<?= $id ?>&delete_answer=<?= $answer['id'] ?>" onclick="return confirm('Supprimer cette réponse ?')">🗑️</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
</div>

<footer>
    <p>&copy; 2025 Quiz Master. Tous droits réservés.</p>
</footer>

</body>
</html>