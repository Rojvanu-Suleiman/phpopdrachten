<?php

use PHPUnit\Framework\TestCase;
use App\Repository\ProductRepository;
use PDO;

class AcceptatieTest extends TestCase
{
    public function testCompleteFlow()
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
            INSERT INTO products VALUES (1, 'Tablet', 299.99)
        ");

        $repo = new ProductRepository($pdo);
        $product = $repo->getProductById(1);

        $this->assertEquals(299.99, $product->getPrice());
    }
}
