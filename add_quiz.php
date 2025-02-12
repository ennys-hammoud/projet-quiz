<?php
session_start();
require 'config.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $theme = trim($_POST["theme"]);

    if (!empty($title) && !empty($theme)) {
        $stmt = $pdo->prepare("INSERT INTO quiz (title, theme) VALUES (?, ?)");
        $stmt->execute([$title, $theme]);
        echo "Quiz ajouté avec succès ! <a href='admin.php'>Retour</a>";
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

<form method="post">
    <input type="text" name="title" placeholder="Titre du quiz" required>
    <input type="text" name="theme" placeholder="Thème (ex: football, cinéma, musique)" required>
    <button type="submit">Ajouter</button>
</form>