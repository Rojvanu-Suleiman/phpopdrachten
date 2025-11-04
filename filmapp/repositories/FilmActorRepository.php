<?php

class FilmActorRepository {
    private PDO $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function linkActorToFilm(int $filmId, int $actorId): void {
        $stmt = $this->conn->prepare("REPLACE INTO film_actor (film_id, actor_id) VALUES (?, ?)");
        $stmt->execute([$filmId, $actorId]);
    }

    public function actorsForFilm(int $filmId): array {
        $stmt = $this->conn->prepare("
            SELECT a.* 
            FROM actors a
            JOIN film_actor fa ON fa.actor_id = a.id
            WHERE fa.film_id = ?
            ORDER BY a.name
        ");
        $stmt->execute([$filmId]);
        return $stmt->fetchAll();
    }

    public function filmsWithActors(): array {
        $sql = "
            SELECT f.id AS film_id, f.name AS film_name, f.genre,
                   GROUP_CONCAT(a.name ORDER BY a.name SEPARATOR ', ') AS actors
            FROM films f
            LEFT JOIN film_actor fa ON fa.film_id = f.id
            LEFT JOIN actors a ON a.id = fa.actor_id
            GROUP BY f.id, f.name, f.genre
            ORDER BY f.name
        ";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }
}
