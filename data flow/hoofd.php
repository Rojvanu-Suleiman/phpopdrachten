<?php
require_once "gebruiker.php";

$beheer = new GebruikerBeheer();

while (true) {
    echo "1: registreren, 2: inloggen, 3: stoppen: ";
    $keuze = trim(fgets(STDIN));
    if ($keuze === "1") {
        echo "naam: ";
        $naam = trim(fgets(STDIN));
        echo "wachtwoord: ";
        $wachtwoord = trim(fgets(STDIN));
        $beheer->registreer_gebruiker($naam, $wachtwoord);
    } elseif ($keuze === "2") {
        echo "naam: ";
        $naam = trim(fgets(STDIN));
        echo "wachtwoord: ";
        $wachtwoord = trim(fgets(STDIN));
        if ($beheer->meld_aan($naam, $wachtwoord)) {
            echo "succesvol\n";
        } else {
            echo "mislukt\n";
        }
    } elseif ($keuze === "3") {
        break;
    }
}
