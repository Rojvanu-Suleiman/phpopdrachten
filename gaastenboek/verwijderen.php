<?php include 'config.php'; ?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!$_SESSION['is_admin']) {
    die("Toegang geweigerd.");
}

$id = intval($_GET['id']);
$conn->query("DELETE FROM berichten WHERE id = $id");
header("Location: dashboard.php");
exit();
?>
