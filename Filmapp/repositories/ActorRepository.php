<?php

require_once __DIR__ . "/../models/Actor.php";

class ActorRepository {
    private PDO $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function create(Actor $actor): int {
        $stmt = $this->conn->prepare("INSERT INTO actors (name) VALUES (?)");
        $stmt->execute([$actor->getName()]);
        return (int)$this->conn->lastInsertId();
    }

    /** @return Actor[] */
    public function all(): array {
        $rows = $this->conn->query("SELECT * FROM actors ORDER BY name")->fetchAll();
        return array_map(fn($r) => new Actor((int)$r['id'], $r['name']), $rows);
    }

    public function find(int $id): ?Actor {
        $stmt = $this->conn->prepare("SELECT * FROM actors WHERE id = ?");
        $stmt->execute([$id]);
        $r = $stmt->fetch();
        if (!$r) return null;
        return new Actor((int)$r['id'], $r['name']);
    }
}
