<?php

include __DIR__ . '/../partials/header.php';
?>
<h1>Overzicht films</h1>
<table>
  <thead>
    <tr><th>Film</th><th>Genre</th><th>Acteurs</th></tr>
  </thead>
  <tbody>
  <?php foreach ($data as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['film_name']) ?></td>
      <td><?= htmlspecialchars($row['genre']) ?></td>
      <td><?= htmlspecialchars($row['actors'] ?? '') ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<p class="muted">Nog niemand gekoppeld? Ga naar <strong>Acteur koppelen</strong>.</p>
<?php include __DIR__ . '/../partials/footer.php'; ?>
