<?php
require_once 'classes/Database.php';  // Pour la connexion à la base de données
require_once 'classes/Quiz.php';     // Pour la classe Quiz
require_once 'classes/Answers.php';   // Pour la classe Answer
require_once 'classes/Question.php'; // Pour la classe Question
require_once 'classes/User.php';     // Pour la classe User

$db = new Database();
$pdo = $db->getConnection();
?>