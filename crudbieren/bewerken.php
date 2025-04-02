<?php
require 'functions.php'; 


if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Geen geldig bier ID opgegeven.");
}

$id = $_GET['id'];
$conn = ConnectDb();


$query = $conn->prepare("SELECT * FROM bier WHERE id = ?");
$query->execute([$id]);
$bier = $query->fetch();

if (!$bier) {
    die("Bier niet gevonden.");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'];
    $soort = $_POST['soort'];
    $stijl = $_POST['stijl'];
    $alcohol = $_POST['alcohol'];
    $brouwcode = $_POST['brouwcode'];
    $barcode = $_POST['barcode'];

    
    $query = $conn->prepare("UPDATE bier SET naam = ?, soort = ?, stijl = ?, alcohol = ?, land = ?, landcode = ?, brouwcode = ?, barcode = ? WHERE id = ?");
    $query->execute([$naam, $soort, $stijl, $alcohol, $land, $landcode, $brouwcode, $barcode, $id]);
    
    
    header("Location: functions.php");
    exit;
}

$brouwerijen = GetBrouwerijen();
$barcodes = GetBarcodes();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bier Bewerken</title>
</head>
<body>

    
    <nav>
        <a href="functions.php" style="font-size: 18px; text-decoration: none; background-color: lightgray; padding: 8px; border-radius: 5px;">🏠 Home</a>
    </nav>

    <h1>Bier Bewerken</h1>
    <form action="bewerken.php?id=<?= $id ?>" method="post">
        <label>Naam:</label>
        <input type="text" name="naam" value="<?= htmlspecialchars($bier['naam']) ?>" required><br>

        <label>Soort:</label>
        <input type="text" name="soort" value="<?= htmlspecialchars($bier['soort']) ?>" required><br>

        <label>Stijl:</label>
        <input type="text" name="stijl" value="<?= htmlspecialchars($bier['stijl']) ?>" required><br>

        <label>Alcoholpercentage:</label>
        <input type="number" name="alcohol" step="0.1" value="<?= htmlspecialchars($bier['alcohol']) ?>" required><br>

        <label>Land:</label>
        <input type="text" name="land" value="<?= htmlspecialchars($bier['land']) ?>" required><br>

        <label>Landcode:</label>
        <input type="text" name="landcode" value="<?= htmlspecialchars($bier['landcode']) ?>" required><br>

        <label>Brouwerij:</label>
        <select name="brouwcode" required>
            <?php foreach ($brouwerijen as $brouwer): ?>
                <option value="<?= $brouwer['brouwcode']; ?>" <?= ($brouwer['brouwcode'] == $bier['brouwcode']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($brouwer['naam']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Barcode:</label>
        <select name="barcode" required>
            <?php foreach ($barcodes as $barcode): ?>
                <option value="<?= $barcode; ?>" <?= ($barcode == $bier['barcode']) ? 'selected' : '' ?>>
                    <?= $barcode; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Opslaan</button>
    </form>

</body>
</html>
