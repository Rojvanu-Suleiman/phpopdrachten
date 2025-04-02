<?php
require 'functions.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'];
    $soort = $_POST['soort'];
    $stijl = $_POST['stijl'];
    $alcohol = $_POST['alcohol'];
    $brouwcode = $_POST['brouwcode'];
    $randomCountries = ['Nederland', 'België', 'Duitsland', 'Verenigde Staten', 'Mexico', 
                    'Ierland', 'Tsjechië', 'Verenigd Koninkrijk', 'Frankrijk', 'Canada', 'Kurdistan'];

$land = $_POST['land'] ?? $randomCountries[array_rand($randomCountries)];

    $barcode = $_POST['barcode']; 

    $conn = ConnectDb();
    $query = $conn->prepare("INSERT INTO bier (naam, soort, stijl, alcohol, land, landcode, brouwcode, barcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $query->execute([$naam, $soort, $stijl, $alcohol, $land, $landcode, $brouwcode, $barcode]);
    

    header("Location: functions.php"); 
    exit;
}

$brouwerijen = GetBrouwerijen();
$barcodes = GetBarcodes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nieuw Bier Toevoegen</title>
</head>
<body>

    
    <nav>
        <a href="functions.php" style="font-size: 18px; text-decoration: none; background-color: lightgray; padding: 8px; border-radius: 5px;">🏠 Home</a>
    </nav>

    <h1>Nieuw Bier Toevoegen</h1>
    <form action="insert_bier.php" method="post">
        <label>Naam:</label>
        <input type="text" name="naam" required><br>

        <label>Soort:</label>
        <input type="text" name="soort" required><br>

        <label>Stijl:</label>
        <input type="text" name="stijl" required><br>

        <label>Alcoholpercentage:</label>
        <input type="number" name="alcohol" step="0.1" required><br>
        
        <label>Land:</label>
        <input type="text" name="land" required><br>

        <label>Landcode:</label>
        <input type="text" name="landcode" required><br>

 
        <label>Brouwerij:</label>
        <select name="brouwcode" required>
            <?php foreach ($brouwerijen as $brouwer): ?>
                <option value="<?= $brouwer['brouwcode']; ?>"><?= htmlspecialchars($brouwer['naam']); ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Barcode:</label>
        <select name="barcode" required>
            <?php foreach ($barcodes as $barcode): ?>
                <option value="<?= $barcode; ?>"><?= $barcode; ?></option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Bier Toevoegen</button>
    </form>
</body>
</html>
