<?php include 'config.php'; ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $email = $_POST["email"];
    $wachtwoord = password_hash($_POST["wachtwoord"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO gebruikers (gebruikersnaam, email, wachtwoord) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $gebruikersnaam, $email, $wachtwoord);
    $stmt->execute();
    echo "Registratie gelukt. <a href='login.php'>Inloggen</a>";
    exit();
}
?>
<link rel="stylesheet" href="style.css">
<form method="post">
    Gebruikersnaam: <input type="text" name="gebruikersnaam" required><br>
    E-mail: <input type="email" name="email" required><br>
    Wachtwoord: <input type="password" name="wachtwoord" required><br>
    <button type="submit">Registreren</button>
</form>
