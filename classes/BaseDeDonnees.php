<?php
class BaseDeDonnees {
    private static $instance = null;
    private $connexion;

    private function __construct() {
        try {
            $this->connexion = new PDO('mysql:host=localhost;dbname=quizz;charset=utf8', 'root', '');
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->creerTableUtilisateursSiInexistante();
            $this->ajouterUtilisateurParDefaut();
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    private function creerTableUtilisateursSiInexistante() {
        $sql = "CREATE TABLE IF NOT EXISTS connexion (
            id INT AUTO_INCREMENT PRIMARY KEY,
            pseudo VARCHAR(255) NOT NULL,
            mdp VARCHAR(255) NOT NULL
        )";
        $this->connexion->exec($sql);
    }

    private function ajouterUtilisateurParDefaut() {
        $pseudo = 'admin';
        $mdp = 'admin123';

        $stmt = $this->connexion->prepare("INSERT INTO connexion (pseudo, mdp) VALUES (:pseudo, :mdp) ON DUPLICATE KEY UPDATE pseudo=pseudo");
        $stmt->execute(['pseudo' => $pseudo, 'mdp' => $mdp]);
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new BaseDeDonnees();
        }
        return self::$instance;
    }

    public function getConnexion() {
        return $this->connexion;
    }
}
?>
