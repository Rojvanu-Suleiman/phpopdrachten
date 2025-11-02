<?php

include __DIR__ . '/../partials/header.php';
?>
<h1>Acteur toevoegen</h1>
<form method="post">
  <label>Naam
    <input type="text" name="name" required>
  </label>
  <button type="submit">Opslaan</button>
</form>
<?php include __DIR__ . '/../partials/footer.php'; ?>
