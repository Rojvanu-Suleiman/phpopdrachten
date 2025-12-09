<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Project\Calculator\classes\Calculator;

$calc = new Calculator();


echo "" . $calc->add(5, 3) . "<br>";

echo "" . $calc->add(10, 8) . "<br>";

