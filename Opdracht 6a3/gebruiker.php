<?php
class User {
    private function dbConnect() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "login";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Verbinding mislukt: " . $e->getMessage());
        }
    }

    public function loginUser($gebruikersnaam, $wachtwoord) {
        $conn = $this->dbConnect();
        $stmt = $conn->prepare("SELECT * FROM user WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(":gebruikersnaam", $gebruikersnaam);
        $stmt->execute();
        $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($gebruiker && password_verify($wachtwoord, $gebruiker["wachtwoord"])) {
            session_start();
            $_SESSION["gebruiker"] = $gebruiker["gebruikersnaam"];
            return true;
        } else {
            return false;
        }
    }
}
?>
