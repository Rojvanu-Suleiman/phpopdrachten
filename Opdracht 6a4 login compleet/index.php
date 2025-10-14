<?php
require_once "db.php";
require_once "gebruiker.php";

$user = new User($conn);

if (!$user->isLoggedIn()) {
    header("Location: inloggen.php");
    exit();
}
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
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        p {
            font-size: 1.2rem;
        }
        a {
            background-color: #ff4747;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }
        a:hover {
            background-color: #e63939;
        }
        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(255,255,255,0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welkom, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
        <p>Je bent succesvol ingelogd.</p>
        <a href="uitloggen.php">Uitloggen</a>
    </div>
</body>
</html>
