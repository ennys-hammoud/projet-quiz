<?php
require 'config.php'; 
session_start();

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Requête pour récupérer l'utilisateur par son nom d'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Vérifier si l'utilisateur existe et si le mot de passe correspond
    if ($user && $password === $user["password"]) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        header("Location: admin.php");
        exit;
    } else {
        echo "Identifiants incorrects.";
    }
}
?>

<!-- Formulaire de connexion -->
<form method="post">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>