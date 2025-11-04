<?php

require_once __DIR__ . "/../models/Film.php";

class FilmRepository {
    private PDO $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function create(Film $film): int {
        $stmt = $this->conn->prepare("INSERT INTO films (name, genre) VALUES (?, ?)");
        $stmt->execute([$film->getName(), $film->getGenre()]);
        return (int)$this->conn->lastInsertId();
    }

    /** @return Film[] */
    public function all(): array {
        $rows = $this->conn->query("SELECT * FROM films ORDER BY name")->fetchAll();
        return array_map(fn($r) => new Film((int)$r['id'], $r['name'], $r['genre']), $rows);
    }

    public function find(int $id): ?Film {
        $stmt = $this->conn->prepare("SELECT * FROM films WHERE id = ?");
        $stmt->execute([$id]);
        $r = $stmt->fetch();
        if (!$r) return null;
        return new Film((int)$r['id'], $r['name'], $r['genre']);
    }
}
