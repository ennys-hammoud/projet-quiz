<?php
session_start();
require_once 'classes/Database.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mdp = htmlspecialchars($_POST['mdp']);

    $bdd = Database::getInstance()->getConnection();
    $stmt = $bdd->prepare("SELECT * FROM connexion WHERE pseudo = :pseudo AND mdp = :mdp");
    $stmt->execute(['pseudo' => $pseudo, 'mdp' => $mdp]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: admin.php');
        exit();
    } else {
        $error_message = 'Nom d\'utilisateur ou mot de passe incorrect.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <div class="logo">Projet Quiz</div>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="connexion.php">Connexion</a></li>
            </ul>
        </nav>
    </header>

    <section class="formulaire">
        <h1>Connexion</h1>
        <?php if ($error_message): ?>
            <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
        <?php endif; ?>
        <form method="post">
            <label for="pseudo">Nom d'utilisateur :</label>
            <input type="text" id="pseudo" name="pseudo" required>
            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" required>
            <input type="submit" value="Se connecter">
        </form>
    </section>

    <footer>
        <p>&copy; 2025 Quizz'APP - Tous droits réservés.</p>
    </footer>

</body>
</html>