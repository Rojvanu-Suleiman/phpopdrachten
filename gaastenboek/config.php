<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$conn = new mysqli("localhost", "root", "", "gastenboek_roles");
if ($conn->connect_error) {
    die("Connectie mislukt: " . $conn->connect_error);
}
?>
