<?php include 'config.php'; ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!$_SESSION['is_admin']) {
    die("Toegang geweigerd.");
}

$id = intval($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tekst = $_POST['tekst'];
    $stmt = $conn->prepare("UPDATE berichten SET berichttekst = ? WHERE id = ?");
    $stmt->bind_param("si", $tekst, $id);
    $stmt->execute();
    header("Location: dashboard.php");
    exit();
}

$result = $conn->query("SELECT berichttekst FROM berichten WHERE id = $id");
$row = $result->fetch_assoc();
?>
<link rel="stylesheet" href="style.css">
<form method="post">
    <textarea name="tekst" required><?= htmlspecialchars($row['berichttekst']) ?></textarea><br>
    <button type="submit">Opslaan</button>
</form>
