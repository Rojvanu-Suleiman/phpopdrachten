<?php

function CrudBieren(){
    echo "<h1>Crud BIER</h1>
    <nav>
        <a href='insert_bier.php'>Toevoegen nieuw biertje</a>
    </nav>";

    $result = GetData("bier");

    PrintCrudBier($result);
}


function GetData($table){
    $conn = ConnectDb();

    $query = $conn->prepare("
        SELECT b.id, b.naam, b.soort, b.stijl, b.alcohol, br.naam AS brouwerij, b.barcode, b.land, b.landcode
        FROM bier b
        JOIN brouwerijen br ON b.brouwcode = br.brouwcode
    ");
    $query->execute();
    return $query->fetchAll();
}


function ConnectDb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bieren";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } catch(PDOException $e) {
        die("Verbinding mislukt: " . $e->getMessage());
    }
}


function GetBrouwerijen() {
    $conn = ConnectDb();
    $query = $conn->prepare("SELECT brouwcode, naam FROM brouwerijen");
    $query->execute();
    return $query->fetchAll();
}


function GetBarcodes() {
    $barcodes = [];
    for ($i = 0; $i < 10; $i++) {
        $barcode = "";
        for ($j = 0; $j < 9; $j++) {
            $barcode .= rand(0, 9); 
        }
        $barcodes[] = $barcode;
    }
    return $barcodes;
}


function PrintCrudBier($result) {
    if (empty($result)) {
        echo "<p>Geen bieren gevonden.</p>";
        return;
    }

    echo "<table border='1'>";
    echo "<tr><th>Naam</th><th>Soort</th><th>Stijl</th><th>Alcohol %</th><th>Brouwerij</th><th>Land</th><th>Landcode</th><th>Barcode</th><th>Acties</th></tr>";

    
    $randomCountries = [
        'Nederland', 'België', 'Duitsland', 'Verenigde Staten', 'Mexico', 
        'Ierland', 'Tsjechië', 'Verenigd Koninkrijk', 'Frankrijk', 'Canada', 'Koerdistan'
    ];

    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['naam']) . "</td>";
        echo "<td>" . htmlspecialchars($row['soort']) . "</td>";
        echo "<td>" . htmlspecialchars($row['stijl']) . "</td>";
        echo "<td>" . htmlspecialchars($row['alcohol']) . "%</td>";
        echo "<td>" . htmlspecialchars($row['brouwerij']) . "</td>";

        
        if (empty($row['land']) || $row['land'] == 'Onbekend') {
            $row['land'] = $randomCountries[array_rand($randomCountries)];
        }

        echo "<td>" . htmlspecialchars($row['land']) . "</td>";
        echo "<td>" . htmlspecialchars($row['landcode']) . "</td>";
        echo "<td>" . htmlspecialchars($row['barcode']) . "</td>"; 

        echo "<td>
                <a href='bewerken.php?id=" . $row['id'] . "'>Bewerken</a> | 
                <a href='delete_bier.php?id=" . $row['id'] . "' onclick='return confirm(\"Weet je zeker dat je dit wilt verwijderen?\");'>Verwijderen</a>
              </td>";

        echo "</tr>";
    }

    echo "</table>";
}


if (basename($_SERVER['PHP_SELF']) == "functions.php") {
    CrudBieren();
}


?>
