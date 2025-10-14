<?php
require_once "db.php";
require_once "gebruiker.php";

$user = new User($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord'];

    if ($user->loginUser($gebruikersnaam, $wachtwoord)) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Ongeldige inloggegevens!";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen</title>
</head>
<body>
    <h2>Inloggen</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <label>Gebruikersnaam:</label><br>
        <input type="text" name="gebruikersnaam" required><br>
        <label>Wachtwoord:</label><br>
        <input type="password" name="wachtwoord" required><br><br>
        <input type="submit" value="Inloggen">
    </form>
    <p>Nog geen account? <a href="registreer.php">Registreer hier</a></p>
</body>
</html>
