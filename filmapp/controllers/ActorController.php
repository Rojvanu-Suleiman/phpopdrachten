<?php

require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../repositories/ActorRepository.php";

class ActorController {
    private PDO $db;
    private ActorRepository $actors;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->actors = new ActorRepository($this->db);
    }

    public function index() {
        $actors = $this->actors->all();
        include __DIR__ . "/../views/actors/index.php";
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = trim($_POST["name"] ?? "");
            if ($name) {
                $actor = new Actor(null, $name);
                $this->actors->create($actor);
                header("Location: index.php?route=actors");
                exit;
            }
        }
        include __DIR__ . "/../views/actors/create.php";
    }
}
