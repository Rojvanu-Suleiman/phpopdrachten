<?php
class GebruikerBeheer {
    private $gebruikers = [];

    public function registreer_gebruiker($naam, $wachtwoord) {
        $sleutel = hash("sha256", $wachtwoord);
        $this->gebruikers[$naam] = $sleutel;
    }

    public function meld_aan($naam, $wachtwoord) {
        $sleutel = hash("sha256", $wachtwoord);
        if (isset($this->gebruikers[$naam]) && $this->gebruikers[$naam] === $sleutel) {
            return true;
        }
        return false;
    }
}
