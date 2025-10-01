<?php
session_start();
require_once __DIR__ . '/gebruiker.php';
$melding = '';
if (isset($_SESSION['melding'])) { $melding = $_SESSION['melding']; unset($_SESSION['melding']); }
?>
<!doctype html>
<html lang="nl">
<head>
<meta charset="utf-8">
<title>Login Toepassing</title>
</head>
<body>
<h1>Login Toepassing</h1>

<?php if ($melding !== ''): ?>
<p><?php echo htmlspecialchars($melding); ?></p>
<?php endif; ?>

<?php if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] === true): ?>
<p>Welkom, <?php echo htmlspecialchars($_SESSION['gebruikersnaam']); ?></p>
<form method="post" action="uitloggen.php">
<button type="submit" name="uit">Uitloggen</button>
</form>
<?php else: ?>

<h2>Registreren</h2>
<form method="post" action="registreer.php">
<label>Naam: <input name="naam" required></label><br>
<label>Wachtwoord: <input name="wachtwoord" type="password" required></label><br>
<button type="submit">Registreer</button>
</form>

<h2>Inloggen</h2>
<form method="post" action="inloggen.php">
<label>Naam: <input name="naam" required></label><br>
<label>Wachtwoord: <input name="wachtwoord" type="password" required></label><br>
<button type="submit">Inloggen</button>
</form>

<?php endif; ?>
</body>
</html>
