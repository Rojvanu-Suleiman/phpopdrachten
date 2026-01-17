<?php
// functie: Programma CRUD fietsen
// auteur: Rojvan

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

use App\Database;
use App\Fiets;

function printCrudTabel(array $result): void
{
    if (count($result) === 0) {
        echo '<p>Geen fietsen gevonden.</p>';
        return;
    }

    $table = '<table>';

    $headers = array_keys($result[0]);
    $table .= '<tr>';
    foreach ($headers as $header) {
        $table .= '<th>' . htmlspecialchars((string)$header) . '</th>';
    }
    $table .= '<th colspan=2>Actie</th>';
    $table .= '</tr>';

    foreach ($result as $row) {
        $table .= '<tr>';
        foreach ($row as $cell) {
            $table .= '<td>' . htmlspecialchars((string)$cell) . '</td>';
        }

        $id = (int)$row['id'];

        $table .= "<td>
            <form method='post' action='update.php?id=$id'>
                <button>Wzg</button>
            </form>
        </td>";

        $table .= "<td>
            <form method='post' action='delete.php?id=$id'>
                <button>Verwijder</button>
            </form>
        </td>";

        $table .= '</tr>';
    }

    $table .= '</table>';

    echo $table;
}

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
