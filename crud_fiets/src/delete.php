<?php
// auteur: Rojvan
// functie: verwijder een fiets op basis van de id

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use App\Database;
use App\Fiets;

$db = Database::connectDb();
$fiets = new Fiets($db);

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($fiets->delete($id)) {
        echo '<script>alert("Fietscode: ' . $id . ' is verwijderd")</script>';
        echo "<script> location.replace('index.php'); </script>";
    } else {
        echo '<script>alert("Fiets is NIET verwijderd")</script>';
    }
}
