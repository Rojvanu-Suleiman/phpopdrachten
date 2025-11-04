<?php
include __DIR__ . '/../partials/header.php';


$db = Database::getInstance()->getConnection();
$genreStmt = $db->query("SELECT * FROM genres ORDER BY name");
$genres = $genreStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h1>Film toevoegen</h1>
<form method="post">
  <label>Filmnaam
    <input type="text" name="name" required>
  </label>
  <label>Genre
    <select name="genre" required>
      <option value="">Kies een genre</option>
      <?php foreach ($genres as $genre): ?>
        <option value="<?= htmlspecialchars($genre['name']) ?>">
          <?= htmlspecialchars($genre['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>
  <button type="submit">Opslaan</button>
</form>
<?php include __DIR__ . '/../partials/footer.php'; ?>