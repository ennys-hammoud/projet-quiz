<?php
session_start();
require 'config.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $pdo->prepare("DELETE FROM quizzes WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: admin.php");
exit;
echo "Quiz supprimé avec succès.";
?>