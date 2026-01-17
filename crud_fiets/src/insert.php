<?php
// functie: formulier en database insert fiets
// auteur: Rojvan

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use App\Database;
use App\Fiets;

echo '<h1>Insert Fiets</h1>';

$db = Database::connectDb();
$fiets = new Fiets($db);

if (isset($_POST) && isset($_POST['btn_ins'])) {
    $merk = (string)($_POST['merk'] ?? '');
    $type = (string)($_POST['type'] ?? '');
    $prijs = (int)($_POST['prijs'] ?? 0);

    if ($fiets->create($merk, $type, $prijs, '')) {
        echo "<script>alert('Fiets is toegevoegd')</script>";
    }
}
?>
<html>
<body>
<form method="post">

    <label for="merk">Merk:</label>
    <input type="text" id="merk" name="merk" required><br>

    <label for="type">Type:</label>
    <input type="text" id="type" name="type" required><br>

    <label for="prijs">Prijs:</label>
    <input type="number" id="prijs" name="prijs" required><br>

    <button type="submit" name="btn_ins">Insert</button>
</form>

<br><br>
<a href='index.php'>Home</a>
</body>
</html>
