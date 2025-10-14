<?php
// User.php
// Bevat alle methodes voor gebruikersfunctionaliteit

require_once "Database.php";

class User {
    private $conn;
    public $username;
    public $password;

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
    public function loginUser() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM user WHERE gebruikersnaam = :gebruikersnaam");
            $stmt->bindParam(':gebruikersnaam', $this->username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($this->password, $user['wachtwoord'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['gebruikersnaam'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
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

    // ✅ Nieuw toegevoegd: check of user ingelogd is
    public function isLoggedin() {
        return isset($_SESSION['user_id']);
    }

    // ✅ Nieuw toegevoegd: valideer inputvelden
    public function validateUser() {
        $errors = [];

        if (empty($this->username)) {
            $errors[] = "Gebruikersnaam is verplicht.";
        }

        if (empty($this->password)) {
            $errors[] = "Wachtwoord is verplicht.";
        }

        return $errors;
    }

    // ✅ Nieuw toegevoegd: haal user op
    public function getUser($gebruikersnaam) {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Nieuw toegevoegd: toon user info (voor debug of homepagina)
    public function showUser() {
        echo "Gebruikersnaam: " . htmlspecialchars($this->username) . "<br>";
    }
}
?>
