<?php include 'config.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = $_POST["wachtwoord"];

    $stmt = $conn->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam = ?");
    $stmt->bind_param("s", $gebruikersnaam);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($wachtwoord, $user["wachtwoord"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["gebruikersnaam"] = $user["gebruikersnaam"];
            $_SESSION["is_admin"] = $user["is_admin"];
            header("Location: dashboard.php");
            exit();
        }
    }
    echo "Ongeldige inloggegevens.";
}
?>
<link rel="stylesheet" href="style.css">
<form method="post">
    Gebruikersnaam: <input type="text" name="gebruikersnaam" required><br>
    Wachtwoord: <input type="password" name="wachtwoord" required><br>
    <button type="submit">Inloggen</button>
</form>
