<?php

require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../repositories/FilmRepository.php";
require_once __DIR__ . "/../repositories/ActorRepository.php";
require_once __DIR__ . "/../repositories/FilmActorRepository.php";

class FilmController {
    private PDO $db;
    private FilmRepository $films;
    private ActorRepository $actors;
    private FilmActorRepository $links;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->films = new FilmRepository($this->db);
        $this->actors = new ActorRepository($this->db);
        $this->links = new FilmActorRepository($this->db);
    }

    public function index() {
        $data = $this->links->filmsWithActors();
        include __DIR__ . "/../views/films/index.php";
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = trim($_POST["name"] ?? "");
            $genre = trim($_POST["genre"] ?? "");
            if ($name && $genre) {
                $film = new Film(null, $name, $genre);
                $this->films->create($film);
                header("Location: index.php?route=films");
                exit;
            }
        }
        include __DIR__ . "/../views/films/create.php";
    }

    public function link() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $filmId = (int)($_POST["film_id"] ?? 0);
            $actorId = (int)($_POST["actor_id"] ?? 0);
            if ($filmId && $actorId) {
                $this->links->linkActorToFilm($filmId, $actorId);
                header("Location: index.php?route=films");
                exit;
            }
        }
        $allFilms = $this->films->all();
        $allActors = $this->actors->all();
        include __DIR__ . "/../views/films/link.php";
    }
}
