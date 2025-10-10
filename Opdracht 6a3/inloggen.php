<?php
require_once "gebruiker.php";
$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = $_POST["wachtwoord"];
    if ($user->loginUser($gebruikersnaam, $wachtwoord)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Onjuiste gebruikersnaam of wachtwoord.";
    }
}
?>
<form method="POST">
    <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required>
    <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
    <button type="submit">Inloggen</button>
</form>
