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
        <?php if (isset($_SESSION['login_error'])): ?>
    <p style="color: red;"><?= $_SESSION['login_error']; ?></p>
    <?php unset($_SESSION['login_error']); ?>
<?php endif; ?>
        <form action="login_process.php" method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
    </section>
<?php require 'footer.php'; ?>


<?php


