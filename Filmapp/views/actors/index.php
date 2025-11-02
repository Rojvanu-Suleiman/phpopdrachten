<?php

include __DIR__ . '/../partials/header.php';
?>
<h1>Acteurs</h1>
<table>
  <thead>
    <tr><th>Naam</th></tr>
  </thead>
  <tbody>
  <?php foreach ($actors as $a): ?>
    <tr><td><?= htmlspecialchars($a->getName()) ?></td></tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php include __DIR__ . '/../partials/footer.php'; ?>
