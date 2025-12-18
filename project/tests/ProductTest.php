<?php

use PHPUnit\Framework\TestCase;
use App\Model\Product;

class ProductTest extends TestCase
{
    public function testGetName()
    {
        $product = new Product(1, "Laptop", 999.99);
        $this->assertEquals("Laptop", $product->getName());
    }

    public function testGetPrice()
    {
        $product = new Product(1, "Laptop", 999.99);
        $this->assertEquals(999.99, $product->getPrice());
    }
}
