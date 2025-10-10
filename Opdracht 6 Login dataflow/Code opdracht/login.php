<?php
require_once __DIR__ . "/user.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["gebruiker"])) {
    header("Location: index.php");
    exit;
}
$melding = "";
$geregistreerd = isset($_GET["geregistreerd"]);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $g = trim($_POST["gebruikersnaam"] ?? "");
    $w = $_POST["wachtwoord"] ?? "";
    $u = new User();
    if ($u->loginUser($g, $w)) {
        header("Location: index.php");
        exit;
    } else {
        $melding = "Onjuiste gegevens.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inloggen</title>
<style>
body{font-family:Arial, sans-serif;background:#f4f4f4;margin:0}
.wrap{max-width:420px;margin:60px auto;background:#fff;padding:24px;border-radius:12px;box-shadow:0 0 12px rgba(0,0,0,.1)}
h1{margin:0 0 16px 0;font-size:22px}
label{display:block;margin-top:12px}
input{width:100%;padding:10px;border:1px solid #ddd;border-radius:8px}
button{margin-top:16px;padding:12px 14px;border:0;border-radius:8px;background:#0d6efd;color:#fff;cursor:pointer;width:100%}
a{display:inline-block;margin-top:12px;text-decoration:none}
.ok{color:#0a7d28;margin-bottom:8px}
.melding{margin-top:10px;color:#b00020}
</style>
</head>
<body>
<div class="wrap">
<h1>Inloggen</h1>
<?php if($geregistreerd){ echo "<div class='ok'>Registratie gelukt. Log in.</div>"; } ?>
<form method="post">
<label>Gebruikersnaam</label>
<input type="text" name="gebruikersnaam" required>
<label>Wachtwoord</label>
<input type="password" name="wachtwoord" required>
<button type="submit">Inloggen</button>
</form>
<?php if($melding!==""){ echo "<div class='melding'>".htmlspecialchars($melding)."</div>"; } ?>
<a href="register_form.php">Account aanmaken</a>
</div>
</body>
</html>
