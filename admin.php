<?php
session_start();
require_once 'classes/Quiz.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

$quiz = new Quiz();
$error_message = '';

// Gérer les actions (ajout, modification, suppression ou création de quiz)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create_quiz']) && !empty($_POST['new_quiz_name'])) {
        $new_quiz_name = htmlspecialchars($_POST['new_quiz_name']);
        try {
            $quiz->createQuiz($new_quiz_name);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
        }
    } else {
        $quiz_id = htmlspecialchars($_POST['quiz_id']);
        if (isset($_POST['add']) && !empty($_POST['question']) && !empty($_POST['reponse'])) {
            $quiz->addQuestion($quiz_id, $_POST['question'], $_POST['reponse']);
        } elseif (isset($_POST['update']) && !empty($_POST['id']) && !empty($_POST['question']) && !empty($_POST['reponse'])) {
            $quiz->updateQuestion($quiz_id, $_POST['id'], $_POST['question'], $_POST['reponse']);
        } elseif (isset($_POST['delete']) && !empty($_POST['id'])) {
            $quiz->deleteQuestion($quiz_id, $_POST['id']);
        } elseif (isset($_POST['add_proposition']) && !empty($_POST['proposition']) && !empty($_POST['question_id'])) {
            $quiz->addProposition($quiz_id, $_POST['question_id'], $_POST['proposition']);
        }
    }
}

$quiz_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 'football';
$questions = $quiz->getQuestions($quiz_id);
$tables_valides = $quiz->getQuizzes();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?= ucfirst($quiz_id) ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <div class="logo">Projet Quiz</div>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="quiz.php">Quiz</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <h1>Gestion des Questions - <?= ucfirst($quiz_id) ?></h1>
    <?php if ($error_message): ?>
        <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>
    <section class="sel">
        <form method="get">
            <label for="quiz_id">Sélectionnez un thème :</label>
            <select name="id" id="quiz_id" onchange="this.form.submit()">
                <?php foreach ($tables_valides as $table) : ?>
                <option value="<?= $table ?>" <?= $quiz_id == $table ? 'selected' : '' ?>><?= ucfirst($table) ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    </section>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Réponse</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($questions as $question) : ?>
            <tr>
                <td><?= htmlspecialchars($question['id']); ?></td>
                <td><?= htmlspecialchars($question['question']); ?></td>
                <td><?= htmlspecialchars($question['reponse']); ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="quiz_id" value="<?= htmlspecialchars($quiz_id); ?>">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($question['id']); ?>">
                        <input type="text" name="question" value="<?= htmlspecialchars($question['question']); ?>">
                        <input type="text" name="reponse" value="<?= htmlspecialchars($question['reponse']); ?>">
                        <button type="submit" name="update">Modifier</button>
                        <button type="submit" name="delete" onclick="return confirm('Supprimer cette question ?');">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Ajouter une nouvelle question</h2>
    <form method="post">
        <input type="hidden" name="quiz_id" value="<?= htmlspecialchars($quiz_id); ?>">
        <label for="question">Question :</label>
        <input type="text" id="question" name="question" required>
        <label for="reponse">Réponse :</label>
        <input type="text" id="reponse" name="reponse" required>
        <button type="submit" name="add">Ajouter</button>
    </form>

    <h2>Ajouter une proposition de réponse</h2>
    <form method="post">
        <input type="hidden" name="quiz_id" value="<?= htmlspecialchars($quiz_id); ?>">
        <label for="question_id">ID de la question :</label>
        <input type="text" id="question_id" name="question_id" required>
        <label for="proposition">Proposition :</label>
        <input type="text" id="proposition" name="proposition" required>
        <button type="submit" name="add_proposition">Ajouter</button>
    </form>

    <h2>Créer un nouveau quiz</h2>
    <form method="post">
        <label for="new_quiz_name">Nom du nouveau quiz :</label>
        <input type="text" id="new_quiz_name" name="new_quiz_name" required>
        <button type="submit" name="create_quiz">Créer</button>
    </form>

    <footer>
        <p>&copy; 2025 Quizz'APP - Tous droits réservés.</p>
    </footer>

</body>
</html>


