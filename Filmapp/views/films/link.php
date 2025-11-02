<?php

include __DIR__ . '/../partials/header.php';
?>
<h1>Acteur koppelen aan film</h1>
<form method="post">
  <label>Film
    <select name="film_id" required>
      <option value="">— kies een film —</option>
      <?php foreach ($allFilms as $f): ?>
        <option value="<?= $f->getId() ?>"><?= htmlspecialchars($f->getName()) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Acteur
    <select name="actor_id" required>
      <option value="">— kies een acteur —</option>
      <?php foreach ($allActors as $a): ?>
        <option value="<?= $a->getId() ?>"><?= htmlspecialchars($a->getName()) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <button type="submit">Koppelen</button>
</form>
<?php include __DIR__ . '/../partials/footer.php'; ?>
