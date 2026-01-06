<?php

namespace App\Repository;

use PDO;
use App\Model\Product;

class ProductRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getProductById(int $id): Product
    {
        $stmt = $this->db->prepare(
            "SELECT id, name, price FROM products WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Product(
            $data['id'],
            $data['name'],
            $data['price']
        );
    }
}
