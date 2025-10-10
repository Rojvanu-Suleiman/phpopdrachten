<?php
require_once __DIR__ . "/user.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$g = trim($_POST["gebruikersnaam"] ?? $_POST["naam"] ?? "");
$e = trim($_POST["email"] ?? "");
$w = $_POST["wachtwoord"] ?? "";
$r = $_POST["rol"] ?? "gebruiker";
if ($g === "" || $e === "" || $w === "") {
    $_SESSION["melding"] = "Vul alle velden in.";
    header("Location: register_form.php");
    exit;
}
$u = new User();
if ($u->registerUser($g, $w, $e, $r)) {
    header("Location: login.php?geregistreerd=1");
    exit;
} else {
    $_SESSION["melding"] = "Gebruiker bestaat al of gegevens ongeldig.";
    header("Location: register_form.php");
    exit;
}
