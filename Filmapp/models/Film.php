<?php

class Film {
    private ?int $id;
    private string $name;
    private string $genre;

    public function __construct(?int $id, string $name, string $genre) {
        $this->id = $id;
        $this->name = $name;
        $this->genre = $genre;
    }

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getGenre(): string { return $this->genre; }

    public function setName(string $name): void { $this->name = $name; }
    public function setGenre(string $genre): void { $this->genre = $genre; }
}
