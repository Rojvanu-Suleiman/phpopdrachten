<?php
require_once __DIR__ . "/user.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$melding = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $g = trim($_POST["gebruikersnaam"] ?? "");
    $e = trim($_POST["email"] ?? "");
    $w = $_POST["wachtwoord"] ?? "";
    $r = $_POST["rol"] ?? "gebruiker";
    $u = new User();
    if ($g !== "" && $e !== "" && $w !== "") {
        if ($u->registerUser($g, $w, $e, $r)) {
            header("Location: login.php?geregistreerd=1");
            exit;
        } else {
            $melding = "Gebruiker bestaat al of gegevens ongeldig.";
        }
    } else {
        $melding = "Vul alle velden in.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registreren</title>
<style>
body{font-family:Arial, sans-serif;background:#f4f4f4;margin:0}
.wrap{max-width:420px;margin:60px auto;background:#fff;padding:24px;border-radius:12px;box-shadow:0 0 12px rgba(0,0,0,.1)}
h1{margin:0 0 16px 0;font-size:22px}
label{display:block;margin-top:12px}
input,select{width:100%;padding:10px;border:1px solid #ddd;border-radius:8px}
button{margin-top:16px;padding:12px 14px;border:0;border-radius:8px;background:#0d6efd;color:#fff;cursor:pointer;width:100%}
a{display:inline-block;margin-top:12px;text-decoration:none}
.melding{margin-top:10px;color:#b00020}
</style>
</head>
<body>
<div class="wrap">
<h1>Registreren</h1>
<form method="post">
<label>Gebruikersnaam</label>
<input type="text" name="gebruikersnaam" required>
<label>Email</label>
<input type="email" name="email" required>
<label>Wachtwoord</label>
<input type="password" name="wachtwoord" required>
<label>Rol</label>
<select name="rol">
<option value="gebruiker">gebruiker</option>
<option value="admin">admin</option>
</select>
<button type="submit">Aanmaken</button>
</form>
<?php if($melding!==""){ echo "<div class='melding'>".htmlspecialchars($melding)."</div>"; } ?>
<a href="login.php">Inloggen</a>
</div>
</body>
</html>
