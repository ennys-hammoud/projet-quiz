<?php
class Database {
    private static $instance = null;
    private $bdd;

    private function __construct() {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=quizz;charset=utf8', 'root', '');
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->bdd;
    }
}
?>
