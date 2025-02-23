<?php
require_once 'Config/Database.php';  // Connexion à la base de données
require_once 'classes/User.php';      // Pour la classe User

$db = new Database();
$pdo = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    
    // Vérification que tous les champs sont remplis
    if (!empty($username) && !empty($password)) {
        
        // Vérifier si l'utilisateur existe déjà
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $existingUser = $stmt->fetch();
        
        if ($existingUser) {
            echo "L'utilisateur existe déjà. Veuillez en choisir un autre.";
        } else {
            // Hachage du mot de passe avec PASSWORD_DEFAULT
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insertion de l'utilisateur dans la base de données
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashedPassword]);
            
            echo "Inscription réussie ! <a href='login.php'>Se connecter</a>";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

<!-- Formulaire d'inscription -->
<form method="post">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">S'inscrire</button>
</form>