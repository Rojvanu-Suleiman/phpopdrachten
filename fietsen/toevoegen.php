<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $merk = $_POST['merk'];
    $type = $_POST['type'];
    $prijs = $_POST['prijs'];

    $query = $conn->prepare("INSERT INTO fietsen (merk, type, prijs) VALUES (?, ?, ?)");
    $query->execute([$merk, $type, $prijs]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
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

    <meta charset="UTF-8">
    <title>Fiets toevoegen</title>
</head>
<body>
    <h1>Nieuwe fiets toevoegen</h1>
    <form method="post">
        Merk: <input type="text" name="merk" required><br>
        Type: <input type="text" name="type" required><br>
        Prijs: <input type="number" name="prijs" required><br>
        <input type="submit" value="Toevoegen">
    </form>
    <br><a href="index.php">Terug</a>
</body>
</html>
