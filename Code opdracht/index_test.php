<?php
    // Functie: programma login OOP 
    // Auteur: Rojvan Suleiman

    // Initialisatie
    include 'classes/User.php';

    //Main
    $piet = new User();
    $piet->username = "Piet";

    $piet->showUser();

    $jan = new User();
    $jan->username = "Jan";
    $jan->showUser();


?>
