<?php
$title = "Connexion";
require 'header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <section class="login-section">
        <h1>Connexion</h1>
        <form action="login_process.php" method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
    </section>
<?php require 'footer.php'; ?>


<?php
// login.php
session_start(); // Démarrer la session

require_once 'classes/Database.php';  // Connexion à la base de données
require_once 'classes/User.php';     // Pour la classe User

$db = new Database();
$user = new User($db);

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if ($user->login($username, $password)) {
        header("Location: admin.php");
        exit;
    } else {
        $error_message = "Identifiants incorrects.";
    }
}
?>
