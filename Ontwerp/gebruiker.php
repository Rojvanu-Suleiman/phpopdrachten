<?php
class GebruikerBeheer {
    private $bestand;
    private $gebruikers;

    public function __construct() {
        $this->bestand = __DIR__ . '/gebruikers.json';
        if (!file_exists($this->bestand)) {
            file_put_contents($this->bestand, json_encode(new stdClass()));
        }
        $data = file_get_contents($this->bestand);
        $this->gebruikers = json_decode($data, true);
        if (!is_array($this->gebruikers)) $this->gebruikers = [];
    }

    public function registreer_gebruiker($naam, $wachtwoord) {
        if (isset($this->gebruikers[$naam])) return false;
        $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $this->gebruikers[$naam] = $hash;
        file_put_contents($this->bestand, json_encode($this->gebruikers, JSON_PRETTY_PRINT));
        return true;
    }

    public function meld_aan($naam, $wachtwoord) {
        if (!isset($this->gebruikers[$naam])) return false;
        return password_verify($wachtwoord, $this->gebruikers[$naam]);
    }
}
