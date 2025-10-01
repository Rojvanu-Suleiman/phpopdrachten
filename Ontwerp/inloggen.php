<?php
session_start();
require_once __DIR__ . '/gebruiker.php';

$beheer = new GebruikerBeheer();
$naam = isset($_POST['naam']) ? trim($_POST['naam']) : '';
$wachtwoord = isset($_POST['wachtwoord']) ? $_POST['wachtwoord'] : '';

if ($beheer->meld_aan($naam, $wachtwoord)) {
    $_SESSION['ingelogd'] = true;
    $_SESSION['gebruikersnaam'] = $naam;
    $_SESSION['melding'] = 'Succesvol ingelogd';
} else {
    $_SESSION['melding'] = 'Inloggen mislukt';
}
header('Location: index.php');
exit;
