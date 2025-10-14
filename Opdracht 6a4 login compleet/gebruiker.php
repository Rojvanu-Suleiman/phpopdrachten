<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
        session_start();
    }

    
    public function registerUser($gebruikersnaam, $wachtwoord) {
        $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO user (gebruikersnaam, wachtwoord) VALUES (?, ?)");
        $stmt->bind_param("ss", $gebruikersnaam, $hash);
        return $stmt->execute();
    }

   
    public function loginUser($gebruikersnaam, $wachtwoord) {
        $stmt = $this->conn->prepare("SELECT wachtwoord FROM user WHERE gebruikersnaam = ?");
        $stmt->bind_param("s", $gebruikersnaam);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($wachtwoord, $row['wachtwoord'])) {
                $_SESSION['user'] = $gebruikersnaam;
                return true;
            }
        }
        return false;
    }

    
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: inloggen.php");
        exit();
    }

    
    public function isLoggedIn() {
        return isset($_SESSION['user']);
    }
}
?>
