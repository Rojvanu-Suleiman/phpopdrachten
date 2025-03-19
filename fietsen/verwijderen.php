<?php
include 'db.php';

$id = $_GET['id'];

$query = $conn->prepare("DELETE FROM fietsen WHERE id = ?");
$query->execute([$id]);

header("Location: index.php");
exit;
?>
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
