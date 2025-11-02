<?php

include __DIR__ . '/../partials/header.php';
?>
<h1>Film toevoegen</h1>
<form method="post">
  <label>Filmnaam
    <input type="text" name="name" required>
  </label>
  <label>Genre
    <input type="text" name="genre" required>
  </label>
  <button type="submit">Opslaan</button>
</form>
<?php include __DIR__ . '/../partials/footer.php'; ?>
