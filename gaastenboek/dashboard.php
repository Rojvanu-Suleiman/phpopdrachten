<?php include 'config.php'; ?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $berichttekst = $_POST["berichttekst"];
    $stmt = $conn->prepare("INSERT INTO berichten (gebruiker_id, berichttekst) VALUES (?, ?)");
    $stmt->bind_param("is", $_SESSION["user_id"], $berichttekst);
    $stmt->execute();
}

$result = $conn->query("SELECT b.id, b.berichttekst, b.aanmaakdatum, g.gebruikersnaam FROM berichten b JOIN gebruikers g ON b.gebruiker_id = g.id ORDER BY b.aanmaakdatum DESC");
?>
<link rel="stylesheet" href="style.css">
<h2>Welkom, <?= $_SESSION['gebruikersnaam'] ?> (<a href="logout.php">Uitloggen</a>)</h2>
<form method="post">
    Bericht: <textarea name="berichttekst" required></textarea><br>
    <button type="submit">Plaatsen</button>
</form>

<h2>Berichten</h2>
<?php while ($row = $result->fetch_assoc()): ?>
    <div>
        <strong><?= htmlspecialchars($row['gebruikersnaam']) ?></strong> (<?= $row['aanmaakdatum'] ?>):<br>
        <?= nl2br(htmlspecialchars($row['berichttekst'])) ?><br>
        <?php if ($_SESSION['is_admin']): ?>
            <a href="bewerken.php?id=<?= $row['id'] ?>">Bewerken</a> |
            <a href="verwijderen.php?id=<?= $row['id'] ?>" onclick="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?');">Verwijderen</a>
        <?php endif; ?>
    </div>
    <hr>
<?php endwhile; ?>
