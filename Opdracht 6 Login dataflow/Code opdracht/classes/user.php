<?php
class User {
    public $gebruikersnaam;
    private $wachtwoord;
    public $email;
    public $rol;

    private function dbConnect() {
        $server = "localhost";
        $gebruiker = "root";
        $ww = "";
        $db = "login";
        $conn = new PDO("mysql:host={$server};dbname={$db};charset=utf8mb4", $gebruiker, $ww);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    public function setPassword($wachtwoord) {
        $this->wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
        return $this->wachtwoord;
    }

    public function getPassword() {
        return $this->wachtwoord;
    }

    public function validateLogin($gebruikersnaam, $wachtwoord) {
        $conn = $this->dbConnect();
        $stmt = $conn->prepare("SELECT id, gebruikersnaam, wachtwoord, email, rol FROM user WHERE gebruikersnaam = :g");
        $stmt->bindParam(":g", $gebruikersnaam);
        $stmt->execute();
        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$r) {
            return false;
        }
        if (!password_verify($wachtwoord, $r["wachtwoord"])) {
            return false;
        }
        $this->gebruikersnaam = $r["gebruikersnaam"];
        $this->wachtwoord = $r["wachtwoord"];
        $this->email = $r["email"];
        $this->rol = $r["rol"];
        return true;
    }

    public function registerUser($gebruikersnaam, $wachtwoord, $email, $rol = "gebruiker") {
        $conn = $this->dbConnect();
        $s = $conn->prepare("SELECT id FROM user WHERE gebruikersnaam = :g OR email = :e");
        $s->bindParam(":g", $gebruikersnaam);
        $s->bindParam(":e", $email);
        $s->execute();
        if ($s->rowCount() > 0) {
            return false;
        }
        $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $i = $conn->prepare("INSERT INTO user (gebruikersnaam, wachtwoord, email, rol) VALUES (:g, :w, :e, :r)");
        $i->bindParam(":g", $gebruikersnaam);
        $i->bindParam(":w", $hash);
        $i->bindParam(":e", $email);
        $i->bindParam(":r", $rol);
        return $i->execute();
    }

    public function loginUser($gebruikersnaam, $wachtwoord) {
        if (!$this->validateLogin($gebruikersnaam, $wachtwoord)) {
            return false;
        }
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["gebruiker"] = $this->gebruikersnaam;
        $_SESSION["rol"] = $this->rol;
        $_SESSION["email"] = $this->email;
        return true;
    }

    public function isLoggedIn() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION["gebruiker"]);
    }

    public function uitloggen() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: login.php");
        exit;
    }
}
?>
