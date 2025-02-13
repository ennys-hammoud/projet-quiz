<?php
session_start();
require_once 'classes/Database.php';  // Connexion DB
require_once 'classes/Quiz.php';     // Classe Quiz
require_once 'classes/Answers.php';  // Classe Answer
require_once 'classes/Question.php'; // Classe Question
require_once 'classes/User.php';     // Classe User

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$db = new Database();
$pdo = $db->getConnection();

// Récupération des statistiques
$quizCount = $pdo->query("SELECT COUNT(*) FROM quizzes")->fetchColumn();
$userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$latestQuizzes = $pdo->query("SELECT title, created_at FROM quizzes ORDER BY created_at DESC LIMIT 5")->fetchAll();

// Récupération de la liste des quiz
$stmt = $pdo->query("SELECT * FROM quizzes ORDER BY created_at DESC");
$quizzes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="styles/admin.css"> <!-- Fichier CSS séparé -->
</head>
<body>
    <nav>
        <ul>
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="add_quiz.php">Ajouter un Quiz</a></li>
            <li><a href="manage_users.php">Gérer les Utilisateurs</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
        </ul>
    </nav>
    
    <h1>Bienvenue, <?= htmlspecialchars($_SESSION["username"]) ?> !</h1>
    
    <section class="stats">
        <div class="stat-box">
            <h3>Total Quiz</h3>
            <p><?= $quizCount ?></p>
        </div>
        <div class="stat-box">
            <h3>Utilisateurs Inscrits</h3>
            <p><?= $userCount ?></p>
        </div>
        <div class="stat-box">
            <h3>Derniers Quiz</h3>
            <ul>
                <?php foreach ($latestQuizzes as $quiz) {
                    echo "<li>" . htmlspecialchars($quiz['title']) . " (" . $quiz['created_at'] . ")</li>";
                } ?>
            </ul>
        </div>
    </section>
    
    <h2>Gestion des Quiz</h2>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Date de Création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quizzes as $quiz) { ?>
                <tr>
                    <td><?= htmlspecialchars($quiz['title']) ?></td>
                    <td><?= htmlspecialchars($quiz['category']) ?></td>
                    <td><?= $quiz['created_at'] ?></td>
                    <td>
                        <a href='edit_quiz.php?id=<?= $quiz['id'] ?>'>Modifier</a> |
                        <a href='manage_questions.php?quiz_id=<?= $quiz['id'] ?>'>Gérer Questions/Réponses</a> |
                        <a href='delete_quiz.php?id=<?= $quiz['id'] ?>' onclick='return confirm("Supprimer ce quiz ?")'>Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
