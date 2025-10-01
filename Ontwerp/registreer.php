<?php
session_start();
require_once __DIR__ . '/gebruiker.php';

$beheer = new GebruikerBeheer();
$naam = isset($_POST['naam']) ? trim($_POST['naam']) : '';
$wachtwoord = isset($_POST['wachtwoord']) ? $_POST['wachtwoord'] : '';

if ($naam === '' || $wachtwoord === '') {
    $_SESSION['melding'] = 'Vul alle velden in';
    header('Location: index.php');
    exit;
}

if ($beheer->registreer_gebruiker($naam, $wachtwoord)) {
    $_SESSION['melding'] = 'Succesvol geregistreerd';
} else {
    $_SESSION['melding'] = 'Naam bestaat al';
}
header('Location: index.php');
exit;
