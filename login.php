<?php
$title = "Connexion";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/projet-quiz/login.css">
    <h1>Quizz'APP</h1>
    <!-- Navbar -->
    <nav>
        <ul>
            <li><a href="/projet-quiz/index.php">Accueil</a></li>
            <li><a href="/projet-quiz/index.php">Quiz</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="/projet-quiz/index.php">Accueil</a></li>
                <li><a href="/projet-quiz/quiz.php">Quiz</a></li>
                <li><a href="/projet-quiz/admin.php">Admin</a></li>
            <?php else: ?>
                <li><a href="/projet-quiz/login.php">Connexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
</head>
<body>
    <section class="login-section">
        <h1>Connexion</h1>
        <?php if (isset($_SESSION['login_error'])): ?>
    <p style="color: red;"><?= $_SESSION['login_error']; ?></p>
    <?php unset($_SESSION['login_error']); ?>
<?php endif; ?>
<form action="login_process.php" method="POST">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required autocomplete="off">
    <input type="password" name="password" placeholder="Mot de passe" required autocomplete="off">
    <button type="submit">Se connecter</button>
</form>
        </form>
    </section>
    <footer>
    <p>&copy; 2025 Quiz Master. Tous droits réservés.</p>
</footer>


<?php


