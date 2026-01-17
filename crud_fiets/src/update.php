<?php
// functie: update fiets
// auteur: Rojvan

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use App\Database;
use App\Fiets;

$db = Database::connectDb();
$fiets = new Fiets($db);

if (isset($_POST['btn_wzg'])) {
    $id = (int)($_POST['id'] ?? 0);
    $merk = (string)($_POST['merk'] ?? '');
    $type = (string)($_POST['type'] ?? '');
    $prijs = (int)($_POST['prijs'] ?? 0);

    if ($fiets->update($id, $merk, $type, $prijs, '')) {
        echo "<script>alert('Fiets is gewijzigd')</script>";
    } else {
        echo '<script>alert("Fiets is NIET gewijzigd")</script>';
    }
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $row = $fiets->read($id);
    if ($row === null) {
        echo 'Geen fiets gevonden<br>';
        exit;
    }
} else {
    echo 'Geen id opgegeven<br>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig Fiets</title>
</head>
<body>
  <h2>Wijzig Fiets</h2>
  <form method="post">

    <input type="hidden" id="merk" name="id" required value="<?php echo htmlspecialchars((string)$row['id']); ?>"><br>
    <label for="merk">Merk:</label>
    <input type="text" id="merk" name="merk" required value="<?php echo htmlspecialchars((string)$row['merk']); ?>"><br>

    <label for="type">Type:</label>
    <input type="text" id="type" name="type" required value="<?php echo htmlspecialchars((string)$row['type']); ?>"><br>

    <label for="prijs">Prijs:</label>
    <input type="number" id="prijs" name="prijs" required value="<?php echo htmlspecialchars((string)$row['prijs']); ?>"><br>

    <button type="submit" name="btn_wzg">Wijzig</button>
  </form>
  <br><br>
  <a href='index.php'>Home</a>
</body>
</html>
