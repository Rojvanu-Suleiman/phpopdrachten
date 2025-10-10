<?php
require_once __DIR__ . "/user.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$u = new User();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Index Test</title>
<style>
body{font-family:Arial, sans-serif;background:#f4f4f4;margin:0}
.container{max-width:600px;margin:80px auto;background:#fff;padding:24px;border-radius:12px;box-shadow:0 0 12px rgba(0,0,0,.1)}
h1{margin:0 0 16px 0;font-size:22px}
p{font-size:16px;color:#333}
a{display:inline-block;margin-top:16px;text-decoration:none;background:#0d6efd;color:#fff;padding:10px 16px;border-radius:8px}
a.logout{background:#dc3545}
</style>
</head>
<body>
<div class="container">
<h1>Index Test</h1>
<?php
if ($u->isLoggedIn()) {
    echo "<p>Je bent ingelogd als <strong>" . htmlspecialchars($_SESSION['gebruiker']) . "</strong>.</p>";
    echo "<p>Email: " . htmlspecialchars($_SESSION['email']) . "</p>";
    echo "<p>Rol: " . htmlspecialchars($_SESSION['rol']) . "</p>";
    echo "<a href='uitloggen.php' class='logout'>Uitloggen</a>";
} else {
    echo "<p>Je bent niet ingelogd.</p>";
    echo "<a href='login.php'>Inloggen</a>";
}
?>
</div>
</body>
</html>
