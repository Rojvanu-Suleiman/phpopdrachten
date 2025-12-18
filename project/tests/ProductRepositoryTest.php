<?php

use PHPUnit\Framework\TestCase;
use App\Repository\ProductRepository;
use PDO;

class ProductRepositoryTest extends TestCase
{
    public function testGetProductById()
    {
        $pdo = new PDO("sqlite::memory:");
        $pdo->exec("
            CREATE TABLE products (
                id INTEGER,
                name TEXT,
                price REAL
            )
        ");

        $pdo->exec("
            INSERT INTO products VALUES (1, 'Phone', 599.99)
        ");

        $repo = new ProductRepository($pdo);
        $product = $repo->getProductById(1);

        $this->assertEquals("Phone", $product->getName());
    }
}
