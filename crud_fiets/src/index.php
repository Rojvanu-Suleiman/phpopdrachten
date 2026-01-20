<?php
// functie: Programma CRUD fietsen
// auteur: Rojvan

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use App\Database;
use App\Fiets;


$db = Database::connectDb();
$fiets = new Fiets($db);
$result = $fiets->getAll();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Crud Fietsen</h1>
<nav>
    <a href='insert.php'>Toevoegen nieuwe fiets</a>
</nav>
<br>

<?php printCrudTabel($result); ?>

</body>
</html>
