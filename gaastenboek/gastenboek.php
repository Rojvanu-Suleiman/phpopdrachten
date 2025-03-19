<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "gastenboek";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $naam = $conn->real_escape_string($_POST["naam"]);
    $bericht = $conn->real_escape_string($_POST["bericht"]);

    $sql = "INSERT INTO berichten (naam, bericht) VALUES ('$naam', '$bericht')";
    $conn->query($sql);
}


if (isset($_GET["delete"])) {
    $id = intval($_GET["delete"]);
    $conn->query("DELETE FROM berichten WHERE id = $id");
    header("Location: gastenboek.php");
    exit();
}


$result = $conn->query("SELECT * FROM berichten ORDER BY datumtijd DESC");
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastenboek</title>
    <style>
        body {
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: white;
            text-align: center;
        }
        .container {
            width: 50%;
            margin: 5% auto;
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
        }
        input, textarea, button {
            width: 90%;
            margin: 5px 0;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }
        button {
            background: #28a745;
            color: white;
            cursor: pointer;
        }
        .message {
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            text-align: left;
        }
        .delete-btn {
            background: #dc3545;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
            float: right;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Laat een bericht achter</h2>
    <form method="post">
        <input type="text" name="naam" placeholder="Jouw naam" required><br>
        <textarea name="bericht" placeholder="Jouw bericht" required></textarea><br>
        <button type="submit" name="submit">Opslaan</button>
    </form>

    <h2>Gastenboek</h2>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <div class="message">
            <strong><?= htmlspecialchars($row['naam']) ?></strong> - <?= $row['datumtijd'] ?><br>
            <?= nl2br(htmlspecialchars($row['bericht'])) ?>
            <a class="delete-btn" href="?delete=<?= $row['id'] ?>" onclick="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?');">Verwijderen</a>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>

<?php $conn->close(); ?>
