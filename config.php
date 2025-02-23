<?php
// Chargement des classes
require_once __DIR__ . 'Config/Database.php';
require_once __DIR__ . '/classes/Quiz.php';
require_once __DIR__ . '/classes/Answers.php';
require_once __DIR__ . '/classes/Question.php';
require_once __DIR__ . '/classes/User.php';

// Initialisation de la connexion à la base de données
$db = new Database();
$pdo = $db->getConnection();
?>