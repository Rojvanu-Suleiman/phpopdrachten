<?php
require_once 'src/Fiets.php';

$db = new PDO('mysql:host=localhost;dbname=fietsenmaker;charset=utf8', 'root', '');
$fiets = new Fiets($db);


if (isset($_POST['toevoegen'])) {
    $fiets->create($_POST['merk'], $_POST['type'], $_POST['prijs']);
}


if (isset($_GET['delete'])) {
    $fiets->delete($_GET['delete']);
}

?>

<h1>Fietsen CRUD</h1>


<form method="post">
    <input name="merk" placeholder="Merk" required>
    <input name="type" placeholder="Type" required>
    <input name="prijs" type="number" step="0.01" placeholder="Prijs" required>
    <button name="toevoegen">Toevoegen</button>
</form>


<table border="1">
    <?php foreach ($fiets->getAll() as $f): ?>
        <td><?= $f['merk'] ?></td>
        <td><?= $f['type'] ?></td>
        <td>€<?= $f['prijs'] ?></td>
        <td>
            <form method="post" style="display:inline">
                <input type="hidden" name="id" value="<?= $f['id'] ?>">
                <input name="merk" value="<?= $f['merk'] ?>">
                <input name="type" value="<?= $f['type'] ?>">
                <input name="prijs" value="<?= $f['prijs'] ?>">
            </form>
            <a href="?delete=<?= $f['id'] ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>