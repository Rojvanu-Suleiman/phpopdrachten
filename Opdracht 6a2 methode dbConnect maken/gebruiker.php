<?php
require_once "db.php";

class User {
    private $conn;

    public function __construct() {
        $this->conn = $this->dbConnect();
    }

    public function dbConnect() {
        $database = new Database();
        return $database->connect();
    }

    public function registerUser($gebruikersnaam, $wachtwoord) {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(":gebruikersnaam", $gebruikersnaam);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false;
        }

        $hashedWachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO user (gebruikersnaam, wachtwoord) VALUES (:gebruikersnaam, :wachtwoord)");
        $stmt->bindParam(":gebruikersnaam", $gebruikersnaam);
        $stmt->bindParam(":wachtwoord", $hashedWachtwoord);
        return $stmt->execute();
    }

    public function loginUser($gebruikersnaam, $wachtwoord) {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(":gebruikersnaam", $gebruikersnaam);
        $stmt->execute();
        $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($gebruiker && password_verify($wachtwoord, $gebruiker['wachtwoord'])) {
            session_start();
            $_SESSION['gebruiker'] = $gebruiker['gebruikersnaam'];
            return true;
        } else {
            return false;
        }
    }

    public function uitloggen() {
        session_start();
        session_destroy();
        header("Location: inloggen.php");
        exit;
    }
}
?>
