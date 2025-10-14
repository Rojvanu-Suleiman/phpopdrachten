<?php
require_once "db.php";
require_once "gebruiker.php";

$user = new User($conn);
$user->logout();
?>
