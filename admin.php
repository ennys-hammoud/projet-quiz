<?php
session_start();
require 'config.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

echo "Bienvenue, " . $_SESSION["username"] . " !";
echo "<h2>Liste des quiz</h2>";

$stmt = $pdo->query("SELECT * FROM quizzes ORDER BY created_at DESC");
$quizzes = $stmt->fetchAll();

foreach ($quizzes as $quiz) {
    echo "<p><strong>{$quiz['title']}</strong> - Thème: {$quiz['category']} ";
    echo "<a href='edit_quiz.php?id={$quiz['id']}'>Modifier</a> | ";
    echo "<a href='delete_quiz.php?id={$quiz['id']}' onclick='return confirm(\"Supprimer ce quiz ?\")'>Supprimer</a>";
    echo "</p>";
}
?>

<a href="add_quiz.php">Ajouter un nouveau quiz</a> |
<a href="logout.php">Se déconnecter</a>