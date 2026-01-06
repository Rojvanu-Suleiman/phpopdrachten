<?php
require_once 'src/Fiets.php';

echo "=== ACCEPTATIETEST FIETS CRUD ===\n\n";

$db = new PDO('mysql:host=localhost;dbname=fietsenmaker;charset=utf8', 'root', '');
$fiets = new Fiets($db);

echo "1. CREATE test: ";
$create = $fiets->create("Gazelle", "Orange C8", 1299.99);
echo $create ? "PASS" : "FAIL";
echo "\n";

echo "2. READ test: ";
$all = $fiets->getAll();
echo count($all) > 0 ? "PASS" : "FAIL";
if (count($all) > 0) {
    $id = $all[0]['id'];
    echo " (ID: $id)";
}
echo "\n";

echo "3. UPDATE test: ";
if (isset($id)) {
    $update = $fiets->update($id, "Batavus", "Updated", 1199.99);
    echo $update ? "PASS" : "FAIL";
} else {
    echo "SKIP";
}
echo "\n";

echo "4. DELETE test: ";
if (isset($id)) {
    $delete = $fiets->delete($id);
    echo $delete ? "PASS" : "FAIL";
} else {
    echo "SKIP";
}
echo "\n";

echo "\n=== TEST VOLTOOID ===\n";