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
    public function register($username, $password) {
        try {
            // Vérifier si le nom d'utilisateur existe déjà
            $query = "SELECT id FROM users WHERE username = :username";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':username' => $username]);
            if ($stmt->rowCount() > 0) {
                return "Nom d'utilisateur déjà pris.";
            }

            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':username' => $username,
                ':password' => $hashedPassword
            ]);
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'inscription : " . $e->getMessage();
            return false;
        }
    }

    // Connexion utilisateur
    public function login($username, $password) {
        try {
            $query = "SELECT id, username, password FROM users WHERE username = :username";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return true;
            } else {
                return "Identifiants incorrects.";
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la connexion : " . $e->getMessage();
            return false;
        }
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
        try {
            $query = "SELECT id, username FROM users WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
            return false;
        }
    }

     // Récupérer tous les utilisateurs
     public function getAllUsers() {
        try {
            $query = "SELECT id, username FROM users";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
            return false;
        }
    }

    // Supprimer un utilisateur
    public function deleteUser($id) {
        try {
            $query = "DELETE FROM users WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
        }
    }

    
}
?>