<?php
require_once "gebruiker.php";
$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = $_POST["wachtwoord"];
    if ($user->registerUser($gebruikersnaam, $wachtwoord)) {
        echo "Registratie gelukt. <a href='inloggen.php'>Inloggen</a>";
    } else {
        echo "Gebruikersnaam bestaat al.";
    }
}
?>
<form method="POST">
    <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required>
    <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
    <button type="submit">Registreer</button>
</form>
