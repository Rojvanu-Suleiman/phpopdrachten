<?php

declare(strict_types=1);

namespace App;

use PDO;
use PDOException;

class Fiets
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create(string $merk, string $type, int $prijs, string $foto = ''): bool
    {
        $sql = 'INSERT INTO ' . CRUD_TABLE . ' (merk, type, prijs, foto) VALUES (:merk, :type, :prijs, :foto)';
        $values = [
            ':merk' => $merk,
            ':type' => $type,
            ':prijs' => $prijs,
            ':foto' => $foto,
        ];

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($values);
            return $stmt->rowCount() === 1;
        } catch (PDOException) {
            return false;
        }
    }

    public function read(int $id): ?array
    {
        $sql = 'SELECT * FROM ' . CRUD_TABLE . ' WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row === false ? null : $row;
    }

    public function update(int $id, string $merk, string $type, int $prijs, string $foto = ''): bool
    {
        $sql = 'UPDATE ' . CRUD_TABLE . ' SET merk = :merk, type = :type, prijs = :prijs, foto = :foto WHERE id = :id';
        $values = [
            ':merk' => $merk,
            ':type' => $type,
            ':prijs' => $prijs,
            ':foto' => $foto,
            ':id' => $id,
        ];

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($values);
            return $stmt->rowCount() === 1;
        } catch (PDOException) {
            return false;
        }
    }

    public function delete(int $id): bool
    {
        $sql = 'DELETE FROM ' . CRUD_TABLE . ' WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() === 1;
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM ' . CRUD_TABLE;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function printCrudTabel(array $result): void
{
    if (count($result) === 0) {
        echo '<p>Geen fietsen gevonden.</p>';
        return;
    }

    $table = '<table>';

    $headers = array_keys($result[0]);
    $table .= '<tr>';
    foreach ($headers as $header) {
        $table .= '<th>' . htmlspecialchars((string)$header) . '</th>';
    }
    $table .= '<th colspan=2>Actie</th>';
    $table .= '</tr>';

    foreach ($result as $row) {
        $table .= '<tr>';
        foreach ($row as $cell) {
            $table .= '<td>' . htmlspecialchars((string)$cell) . '</td>';
        }

        $id = (int)$row['id'];

        $table .= "<td>
            <form method='post' action='update.php?id=$id'>
                <button>Wzg</button>
            </form>
        </td>";

        $table .= "<td>
            <form method='post' action='delete.php?id=$id'>
                <button>Verwijder</button>
            </form>
        </td>";

        $table .= '</tr>';
    }

    $table .= '</table>';

    echo $table;
}

}
