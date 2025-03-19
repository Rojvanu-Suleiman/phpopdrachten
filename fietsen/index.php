<?php
include 'db.php';


$query = $conn->query("SELECT * FROM fietsen");
$fietsen = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>FietsenShop</title>
    <style>
        table { border-collapse: collapse; width: 50%; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: lightblue; }
    </style>
    <style>
    body {
        background-image: url('background.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        font-family: Arial, sans-serif;
        color: white;
        text-align: center;
    }

    table {
        margin: auto;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        border-collapse: collapse;
        width: 60%;
    }

    th, td {
        border: 1px solid white;
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: rgba(255, 255, 255, 0.3);
    }

    a {
        color: yellow;
        text-decoration: none;
    }

    a:hover {
        color: orange;
    }

    h1 {
        text-shadow: 2px 2px 5px black;
    }

    form {
        background-color: rgba(0, 0, 0, 0.7);
        display: inline-block;
        padding: 20px;
        border-radius: 10px;
    }

    input, button {
        padding: 10px;
        margin: 5px;
    }
</style>

</head>
<body>
    
    <img src="fiets.jpeg" width="200" alt="Fiets">
    <br><a href="toevoegen.php">Fiets toevoegen</a>
    <table>
        <tr>
            <th>Merk</th>
            <th>Type</th>
            <th>Prijs</th>
            <th>Wijzig</th>
            <th>Verwijderen</th>
        </tr>
        <?php foreach ($fietsen as $fiets): ?>
            <tr>
                <td><?= htmlspecialchars($fiets['merk']) ?></td>
                <td><?= htmlspecialchars($fiets['type']) ?></td>
                <td>€<?= htmlspecialchars($fiets['prijs']) ?></td>
                <td><a href="bewerken.php?id=<?= $fiets['id'] ?>">Wijzig</a></td>
                <td><a href="verwijderen.php?id=<?= $fiets['id'] ?>" onclick="return confirm('Weet je het zeker?')">Verwijder</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
