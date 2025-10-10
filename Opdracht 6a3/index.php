<?php
session_start();
if (!isset($_SESSION['gebruiker'])) {
    header("Location: inloggen.php");
    exit;
}
$gebruiker = $_SESSION['gebruiker'];
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkom</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 500px;
            margin: 80px auto;
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            text-align: center;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 17px;
            color: #555;
        }
        a {
            display: inline-block;
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 6px;
        }
        a:hover {
            background-color: #0056b3;
        }
        .info {
            margin-top: 30px;
            text-align: left;
        }
        .info ul {
            list-style-type: square;
        }
        .logout {
            background-color: #dc3545;
        }
        .logout:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welkom <?php echo htmlspecialchars($gebruiker); ?></h1>
        <p>Je bent succesvol ingelogd op de beveiligde omgeving.</p>
        <div class="info">
            <h3>Wat kan je hier doen:</h3>
            <ul>
                <li>Bekijk je profielinformatie</li>
                <li>Beheer je account</li>
                <li>Registreer nieuwe gebruikers</li>
                <li>Test de login functionaliteit</li>
            </ul>
        </div>
        <a href="registreer.php">Nieuwe gebruiker registreren</a>
        <a href="uitloggen.php" class="logout">Uitloggen</a>
    </div>
</body>
</html>
