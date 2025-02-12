<?php
session_start();
require 'config.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET["id"])) {
    header("Location: admin.php");
    exit;
}

$id = $_GET["id"];
$stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id = ?");
$stmt->execute([$id]);
$quiz = $stmt->fetch();

if (!$quiz) {
    echo "Quiz introuvable.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $theme = trim($_POST["theme"]);

    if (!empty($title) && !empty($theme)) {
        $stmt = $pdo->prepare("UPDATE quiz SET title = ?, theme = ? WHERE id = ?");
        $stmt->execute([$title, $theme, $id]);
        header("Location: admin.php");
        exit;
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

<form method="post">
    <input type="text" name="title" value="<?= htmlspecialchars($quiz['title']) ?>" required>
    <input type="text" name="theme" value="<?= htmlspecialchars($quiz['theme']) ?>" required>
    <button type="submit">Modifier</button>
</form>