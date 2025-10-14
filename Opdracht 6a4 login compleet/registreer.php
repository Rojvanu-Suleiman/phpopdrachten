<?php
require_once "db.php";
require_once "gebruiker.php";

$user = new User($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord'];

    if ($user->registerUser($gebruikersnaam, $wachtwoord)) {
        echo "<p>Registratie succesvol! <a href='inloggen.php'>Klik hier om in te loggen</a></p>";
    } else {
        echo "<p style='color:red;'>Fout bij registratie. Gebruikersnaam bestaat misschien al.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
</head>
<body>
    <h2>Registreren</h2>
    <form method="post">
        <label>Gebruikersnaam:</label><br>
        <input type="text" name="gebruikersnaam" required><br>
        <label>Wachtwoord:</label><br>
        <input type="password" name="wachtwoord" required><br><br>
        <input type="submit" value="Registreren">
    </form>
    <p>Al een account? <a href="inloggen.php">Log hier in</a></p>
</body>
</html>
