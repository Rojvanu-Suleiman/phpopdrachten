<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Fiets;

final class FietsTest extends TestCase
{
    private PDO $pdo;
    private Fiets $fiets;

    protected function setUp(): void
    {
        require_once __DIR__ . '/../vendor/autoload.php';
        require_once __DIR__ . '/../src/config.php';

        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $this->pdo->exec(
            'CREATE TABLE fietsen (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                merk TEXT NOT NULL,
                type TEXT NOT NULL,
                prijs INTEGER NOT NULL,
                foto TEXT NOT NULL
            )'
        );

        $this->fiets = new Fiets($this->pdo);
    }

    public function testCreate(): void
    {
        $ok = $this->fiets->create('Gazelle', 'City', 699, '');
        $this->assertTrue($ok);

        $rows = $this->fiets->getAll();
        $this->assertCount(1, $rows);
        $this->assertSame('Gazelle', $rows[0]['merk']);
    }

    public function testGetAll(): void
    {
        $this->fiets->create('Batavus', 'Speed', 500, '');
        $this->fiets->create('Cube', 'MTB', 1200, '');

        $rows = $this->fiets->getAll();
        $this->assertCount(2, $rows);
    }

    public function testRead(): void
    {
        $this->fiets->create('Koga', 'Road', 1500, '');
        $rows = $this->fiets->getAll();
        $id = (int)$rows[0]['id'];

        $row = $this->fiets->read($id);
        $this->assertNotNull($row);
        $this->assertSame('Koga', $row['merk']);
    }

    public function testUpdate(): void
    {
        $this->fiets->create('Sparta', 'E-bike', 2200, '');
        $rows = $this->fiets->getAll();
        $id = (int)$rows[0]['id'];

        $ok = $this->fiets->update($id, 'Sparta', 'E-bike 2', 2300, '');
        $this->assertTrue($ok);

        $row = $this->fiets->read($id);
        $this->assertNotNull($row);
        $this->assertSame('E-bike 2', $row['type']);
        $this->assertSame(2300, (int)$row['prijs']);
    }

    public function testDelete(): void
    {
        $this->fiets->create('Sensa', 'Hybrid', 800, '');
        $rows = $this->fiets->getAll();
        $id = (int)$rows[0]['id'];

        $ok = $this->fiets->delete($id);
        $this->assertTrue($ok);

        $this->assertNull($this->fiets->read($id));
        $this->assertCount(0, $this->fiets->getAll());
    }
}
