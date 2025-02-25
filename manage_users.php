<?php
session_start();
require_once __DIR__ . '/Config/Database.php';
require_once 'classes/User.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$db = new Database(); // Création de l'objet Database
$user = new User($db);  // Passer l'objet Database, pas PDO
$users = $user->getAllUsers();  // Récupérer tous les utilisateurs

// Suppression d'un utilisateur
if (isset($_GET['delete_id'])) {
    $userIdToDelete = $_GET['delete_id'];
    $user->deleteUser($userIdToDelete);
    header("Location: manage_users.php");
    exit;
}

$title = "Gestion des utilisateurs";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Quiz App' ?></title>
    <link rel="stylesheet" href="admin.css">
    
</head>
<body>
<header>
    <h1>Quizz'APP</h1>
    <!-- Navbar -->
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php">Quiz</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="login.php">Connexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<nav class="admin-nav">
    <ul>
        <li><a href="add_quiz.php">Ajouter un Quiz</a></li>
        <li><a href="manage_users.php">Gérer les Utilisateurs</a></li>
        <li><a href="logout.php">Déconnexion</a></li>
    </ul>
</nav>

<h1>Gestion des Utilisateurs</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td>
                    <a href="?delete_id=<?php echo $user['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<footer>
    <p>&copy; 2025 Quiz Master. Tous droits réservés.</p>
</footer>

</body>
</html>