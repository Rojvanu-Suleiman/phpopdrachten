<?php
// Rojvan


$host = 'localhost';
$db   = 'opdrachten_db'; 
$user = 'root';         
$pass = '';              
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

// Opdracht 1:
function generatePassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $password;
}

// Opdracht 2:
function getBrowser($user_agent) {
    if (strpos($user_agent, 'Chrome') !== false) return 'Google Chrome';
    if (strpos($user_agent, 'Firefox') !== false) return 'Firefox';
    if (strpos($user_agent, 'MSIE') !== false || strpos($user_agent, 'Trident') !== false) return 'Internet Explorer';
    return 'Unknown';
}

function getOS($user_agent) {
    if (strpos($user_agent, 'Windows NT 10.0') !== false) return 'Windows 10';
    if (strpos($user_agent, 'Windows NT 6.1') !== false) return 'Windows 7';
    if (strpos($user_agent, 'Mac OS X') !== false) return 'Mac OS X';
    if (strpos($user_agent, 'Linux') !== false) return 'Linux';
    return 'Unknown';
}


$user_agent = $_SERVER['HTTP_USER_AGENT'];
$browser = getBrowser($user_agent);
$os = getOS($user_agent);


$stmt = $pdo->prepare("INSERT INTO statistieken (browser, os) VALUES (?, ?)");
$stmt->execute([$browser, $os]);

// Opdracht 3:
$stat_query = $pdo->query("SELECT browser, COUNT(*) AS aantal FROM statistieken GROUP BY browser ORDER BY aantal DESC");
$stats = $stat_query->fetchAll();

// Opdracht 4: 
$cijfers_query = $pdo->query("SELECT leerling, cijfer FROM cijfersysteem");
$cijfers = $cijfers_query->fetchAll();

$gemiddeld = $pdo->query("SELECT AVG(cijfer) AS gemiddeld FROM cijfersysteem")->fetch()['gemiddeld'];
$hoogste = $pdo->query("SELECT MAX(cijfer) AS hoogste FROM cijfersysteem")->fetch()['hoogste'];
$laagste = $pdo->query("SELECT MIN(cijfer) AS laagste FROM cijfersysteem")->fetch()['laagste'];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Hoofdstuk 10 opdrachten</title>
    <style>
        body {
            background-image: url('background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            font-family: Arial, sans-serif;
            color: #fff;
            text-shadow: 1px 1px 3px #000;
        }

        table {
            background-color: rgba(0, 0, 0, 0.6);
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #fff;
            padding: 8px 12px;
        }

        h1 {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <h1>Opdracht 1: Wachtwoord generator</h1>
    <p>Willekeurig wachtwoord van 10 tekens: <strong><?= generatePassword(10) ?></strong></p>

    <h1>Opdracht 2: Browser en besturingssysteem</h1>
    <p><strong>Browser:</strong> <?= $browser ?></p>
    <p><strong>Besturingssysteem:</strong> <?= $os ?></p>

    <h1>Opdracht 3: Bezoeken per webbrowser</h1>
    <table border="1">
        <tr><th>Webbrowser</th><th>Bezoeken</th></tr>
        <?php foreach ($stats as $row): ?>
        <tr><td><?= $row['browser'] ?></td><td><?= $row['aantal'] ?></td></tr>
        <?php endforeach; ?>
    </table>

    <h1>Opdracht 4: Cijfersysteem overzicht</h1>
    <table border="1">
        <tr><th>Leerling</th><th>Cijfer</th></tr>
        <?php foreach ($cijfers as $leerling): ?>
        <tr><td><?= $leerling['leerling'] ?></td><td><?= $leerling['cijfer'] ?></td></tr>
        <?php endforeach; ?>
    </table>
    <p>Het gemiddelde cijfer is: <strong><?= number_format($gemiddeld, 1) ?></strong></p>
    <p>Het hoogste cijfer is: <strong><?= $hoogste ?></strong></p>
    <p>Het laagste cijfer is: <strong><?= $laagste ?></strong></p>
</body>
</html>
