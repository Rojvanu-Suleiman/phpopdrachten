<?php

require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../controllers/FilmController.php";
require_once __DIR__ . "/../controllers/ActorController.php";

$route = $_GET['route'] ?? 'home';

$filmController = new FilmController();
$actorController = new ActorController();

switch ($route) {
    case 'home':
        include __DIR__ . "/../views/partials/header.php";
        include __DIR__ . "/../views/home.php";
        include __DIR__ . "/../views/partials/footer.php";
        break;

    case 'films':
        $filmController->index();
        break;

    case 'films_create':
        $filmController->create();
        break;

    case 'films_link':
        $filmController->link();
        break;

    case 'actors':
        $actorController->index();
        break;

    case 'actors_create':
        $actorController->create();
        break;

    default:
        http_response_code(404);
        echo "404 Not Found";
}
