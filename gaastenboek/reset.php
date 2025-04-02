<?php include 'config.php'; ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $nieuwWachtwoord = password_hash($_POST["nieuw_wachtwoord"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE gebruikers SET wachtwoord = ? WHERE email = ?");
    $stmt->bind_param("ss", $nieuwWachtwoord, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Wachtwoord succesvol gereset. <a href='login.php'>Inloggen</a>";
    } else {
        echo "Gebruiker met dit e-mailadres niet gevonden.";
    }
}
?>
<link rel="stylesheet" href="style.css">
<form method="post">
    E-mailadres: <input type="email" name="email" required><br>
    Nieuw wachtwoord: <input type="password" name="nieuw_wachtwoord" required><br>
    <button type="submit">Reset wachtwoord</button>
</form>
