<?php
require_once 'Database.php'; // Database connection class

class User {
    private $pdo;

    public function __construct(Database $db) {
        $this->pdo = $db->getConnection();
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Assurer que la session est démarrée
        }
    }

    // Inscription utilisateur
    public function register($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ':username' => $username,
            ':password' => $hashedPassword
        ]);
    }

    // Connexion utilisateur
    public function login($username, $password){
        $query = "SELECT id, username, password FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
        return false;
    }

    // Vérifier si l'utilisateur est connecté
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // Déconnexion utilisateur
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }

    // Récupérer un utilisateur par son ID
    public function getUserById($id) {
        $query = "SELECT id, username FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
}