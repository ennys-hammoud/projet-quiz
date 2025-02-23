<?php
class Database {
    private $host = 'localhost'; // Pas besoin de préciser le port ici
    private $dbname = 'ennys-hammoud_quiznight'; 
    private $username = 'ennys-hammoud'; 
    private $password = 'Ennys1502@'; 
    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host=$this->host;port=3306;dbname=$this->dbname;charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>