<?php
// db.php
// Verantwoordelijk voor database connectie

class Database {
    private $host = "localhost";
    private $dbname = "login";
    private $username = "root";
    private $password = "";
    private static $instance = null;
    private $conn;

    private function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Verbinding mislukt: " . $e->getMessage());
        }
    }

    // Singleton (altijd 1 verbinding)
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
