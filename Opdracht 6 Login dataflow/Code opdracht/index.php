<?php
require_once __DIR__ . "/user.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["gebruiker"])) {
    header("Location: login.php");
    exit;
}
$naam = $_SESSION["gebruiker"];
$email = $_SESSION["email"];
$rol = $_SESSION["rol"];
?>
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welkom</title>
<style>
body{font-family:Arial, sans-serif;background:#f4f4f4;margin:0}
.wrap{max-width:600px;margin:60px auto;background:#fff;padding:24px;border-radius:12px;box-shadow:0 0 12px rgba(0,0,0,.1)}
h1{margin:0 0 16px 0;font-size:22px}
p{font-size:16px;color:#333}
a{display:inline-block;margin-top:16px;text-decoration:none;background:#dc3545;color:#fff;padding:10px 16px;border-radius:8px}
a:hover{background:#a71d2a}
</style>
</head>
<body>
<div class="wrap">
<h1>Welkom <?php echo htmlspecialchars($naam); ?></h1>
<p>Email: <?php echo htmlspecialchars($email); ?></p>
<p>Rol: <?php echo htmlspecialchars($rol); ?></p>
<p>Je bent succesvol ingelogd in de beveiligde omgeving.</p>
<a href="uitloggen.php">Uitloggen</a>
</div>
</body>
</html>
