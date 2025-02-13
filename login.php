<?php
session_start(); // Démarrer la session

require_once 'classes/Database.php';  // Connexion à la base de données
require_once 'classes/User.php';     // Pour la classe User

$db = new Database();
$pdo = $db->getConnection();
$user = new User($db);

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Requête pour récupérer l'utilisateur par son nom d'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $userRecord = $stmt->fetch();

    // Vérifier si l'utilisateur existe et si le mot de passe correspond
    if ($userRecord && password_verify($password, $userRecord["password"])) {
        $_SESSION["user_id"] = $userRecord["id"];
        $_SESSION["username"] = $userRecord["username"];
        header("Location: admin.php");  // Rediriger vers la page admin après connexion
        exit;
    } else {
        $error_message = "Identifiants incorrects.";
    }
}
?>

<!-- Formulaire de connexion -->
<h2>Connexion</h2>
    <?php if (isset($error_message)): ?>
        <p class="error-message"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>

<?php
// Afficher le message d'erreur si nécessaire
if (isset($error_message)) {
    echo "<p style='color: red;'>" . htmlspecialchars($error_message) . "</p>";
}
?>

