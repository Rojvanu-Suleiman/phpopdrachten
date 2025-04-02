<?php
require 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = ConnectDb();
    $query = $conn->prepare("DELETE FROM bier WHERE id = ?");
    $query->execute([$id]);
}

header("Location: functions.php");
exit;
?>
