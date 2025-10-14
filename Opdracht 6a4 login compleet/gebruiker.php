<?php
// User.php
// Bevat alle methodes voor gebruikersfunctionaliteit

require_once "db.php";

class User {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // Methode om een gebruiker te registreren
    public function registerUser($gebruikersnaam, $wachtwoord) {
        try {
            // Controleer of gebruiker al bestaat
            $check = $this->conn->prepare("SELECT * FROM user WHERE gebruikersnaam = :gebruikersnaam");
            $check->bindParam(':gebruikersnaam', $gebruikersnaam);
            $check->execute();

            if ($check->rowCount() > 0) {
                return "Gebruiker bestaat al.";
            }

            // Hash wachtwoord en voeg toe
            $hashedPassword = password_hash($wachtwoord, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("INSERT INTO user (gebruikersnaam, wachtwoord) VALUES (:gebruikersnaam, :wachtwoord)");
            $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
            $stmt->bindParam(':wachtwoord', $hashedPassword);
            $stmt->execute();

            return "Registratie succesvol.";
        } catch (PDOException $e) {
            return "Fout bij registratie: " . $e->getMessage();
        }
    }

    // Methode om in te loggen
    public function loginUser($gebruikersnaam, $wachtwoord) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM user WHERE gebruikersnaam = :gebruikersnaam");
            $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($wachtwoord, $user['wachtwoord'])) {
                session_start();
                $_SESSION['user'] = $user['gebruikersnaam'];
                return "Inloggen gelukt.";
            } else {
                return "Ongeldige gebruikersnaam of wachtwoord.";
            }
        } catch (PDOException $e) {
            return "Fout bij inloggen: " . $e->getMessage();
        }
    }

    // Methode om uit te loggen
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>
