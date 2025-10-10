<?php
require_once __DIR__ . "/user.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$g = trim($_POST["gebruikersnaam"] ?? $_POST["naam"] ?? "");
$w = $_POST["wachtwoord"] ?? "";
if ($g === "" || $w === "") {
    $_SESSION["melding"] = "Vul alle velden in.";
    header("Location: index.php");
    exit;
}
$u = new User();
if ($u->loginUser($g, $w)) {
    $_SESSION["melding"] = "Succesvol ingelogd.";
    header("Location: index.php");
    exit;
} else {
    $_SESSION["melding"] = "Inloggen mislukt.";
    header("Location: index.php");
    exit;
}
