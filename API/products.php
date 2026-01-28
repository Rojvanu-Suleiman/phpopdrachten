<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

header('Content-Type: application/json; charset=utf-8');

function respond(int $status, array $data = null): void
{
    http_response_code($status);

    if ($data !== null) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    exit;
}

function getJsonBody(): array
{
    $raw = file_get_contents('php://input');

    if ($raw === false) {
        respond(500, ['error' => 'Could not read request body.']);
    }

    $data = json_decode($raw, true);

    if (!is_array($data)) {
        respond(400, ['error' => 'Invalid JSON body. Send JSON like {"naam":"Cola","prijs":1.99}.']);
    }

    return $data;
}

function getIdFromQuery(): ?int
{
    if (!isset($_GET['id'])) return null;

    if (!ctype_digit((string)$_GET['id'])) {
        respond(400, ['error' => 'Invalid id. Must be an integer.']);
    }

    return (int)$_GET['id'];
}

function validateProduct(array $data): array
{
    $naam = isset($data['naam']) ? trim((string)$data['naam']) : '';
    $prijsRaw = $data['prijs'] ?? null;

    if ($naam === '') {
        respond(400, ['error' => 'Validatie fout: "naam" is verplicht.']);
    }

    if (mb_strlen($naam) > 50) {
        respond(400, ['error' => 'Validatie fout: "naam" mag maximaal 50 tekens zijn.']);
    }

    if ($prijsRaw === null || $prijsRaw === '') {
        respond(400, ['error' => 'Validatie fout: "prijs" is verplicht.']);
    }

    if (!is_numeric($prijsRaw)) {
        respond(400, ['error' => 'Validatie fout: "prijs" moet een getal zijn.']);
    }

    $prijs = (float)$prijsRaw;

    if ($prijs < 0) {
        respond(400, ['error' => 'Validatie fout: "prijs" mag niet negatief zijn.']);
    }

    return ['naam' => $naam, 'prijs' => $prijs];
}

try {
    $pdo = pdo();
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    $id = getIdFromQuery();

    
    if ($method === 'GET') {
        if ($id === null) {
            $stmt = $pdo->query("SELECT id, naam, prijs, created_at, updated_at FROM producten ORDER BY id DESC");
            $rows = $stmt->fetchAll();
            respond(200, ['data' => $rows]);
        } else {
            $stmt = $pdo->prepare("SELECT id, naam, prijs, created_at, updated_at FROM producten WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $row = $stmt->fetch();

            if (!$row) {
                respond(404, ['error' => 'Product not found.']);
            }

            respond(200, ['data' => $row]);
        }
    }

    
    if ($method === 'POST') {
        $data = getJsonBody();
        $v = validateProduct($data);

        
        $check = $pdo->prepare("SELECT id FROM producten WHERE naam = :naam LIMIT 1");
        $check->execute([':naam' => $v['naam']]);
        if ($check->fetch()) {
            respond(400, ['error' => 'Validatie fout: "naam" bestaat al (moet uniek zijn).']);
        }

        $stmt = $pdo->prepare("INSERT INTO producten (naam, prijs) VALUES (:naam, :prijs)");
        $stmt->execute([
            ':naam' => $v['naam'],
            ':prijs' => $v['prijs']
        ]);

        $newId = (int)$pdo->lastInsertId();

        $stmt = $pdo->prepare("SELECT id, naam, prijs, created_at, updated_at FROM producten WHERE id = :id");
        $stmt->execute([':id' => $newId]);
        $created = $stmt->fetch();

        respond(201, ['message' => 'Product created.', 'data' => $created]);
    }

    
    if ($method === 'PUT') {
        if ($id === null) {
            respond(400, ['error' => 'Missing id. Use /API/products.php?id=123']);
        }

        $exists = $pdo->prepare("SELECT id FROM producten WHERE id = :id");
        $exists->execute([':id' => $id]);
        if (!$exists->fetch()) {
            respond(404, ['error' => 'Product not found.']);
        }

        $data = getJsonBody();
        $v = validateProduct($data);

        
        $check = $pdo->prepare("SELECT id FROM producten WHERE naam = :naam AND id <> :id LIMIT 1");
        $check->execute([':naam' => $v['naam'], ':id' => $id]);
        if ($check->fetch()) {
            respond(400, ['error' => 'Validatie fout: "naam" bestaat al (moet uniek zijn).']);
        }

        $stmt = $pdo->prepare("UPDATE producten SET naam = :naam, prijs = :prijs WHERE id = :id");
        $stmt->execute([
            ':naam' => $v['naam'],
            ':prijs' => $v['prijs'],
            ':id' => $id
        ]);

        $stmt = $pdo->prepare("SELECT id, naam, prijs, created_at, updated_at FROM producten WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $updated = $stmt->fetch();

        respond(200, ['message' => 'Product updated.', 'data' => $updated]);
    }

    
    if ($method === 'DELETE') {
        if ($id === null) {
            respond(400, ['error' => 'Missing id. Use /API/products.php?id=123']);
        }

        $stmt = $pdo->prepare("DELETE FROM producten WHERE id = :id");
        $stmt->execute([':id' => $id]);

        if ($stmt->rowCount() === 0) {
            respond(404, ['error' => 'Product not found.']);
        }

        respond(204);
    }

    
    respond(405, ['error' => 'Method not allowed. Use GET, POST, PUT, DELETE.']);

} catch (PDOException $e) {
    
    if ((int)$e->getCode() === 23000) {
        respond(400, ['error' => 'Database fout: "naam" moet uniek zijn.']);
    }

    respond(500, ['error' => 'Server error.', 'details' => $e->getMessage()]);
} catch (Throwable $e) {
    respond(500, ['error' => 'Server error.', 'details' => $e->getMessage()]);
}
