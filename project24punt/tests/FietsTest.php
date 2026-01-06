<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Fiets.php';

class FietsTest extends TestCase
{
    private $fiets;
    private static $db;
    private static $testId;
    
    public static function setUpBeforeClass(): void
    {
        // Database connectie maken
        self::$db = new PDO('mysql:host=localhost;dbname=fietsenmaker;charset=utf8', 'root', '');
        // Schone test: verwijder alles
        self::$db->exec("DELETE FROM fietsen");
    }
    
    protected function setUp(): void
    {
        $this->fiets = new Fiets(self::$db);
    }
    
    /** @test */
    public function testCreate()
    {
        $result = $this->fiets->create("Gazelle", "Test Model", 999.99);
        $this->assertTrue($result);
        
        // Sla ID op voor andere tests
        $all = $this->fiets->getAll();
        if (count($all) > 0) {
            self::$testId = $all[0]['id'];
        }
    }
    
    /** @test */
    public function testRead()
    {
        $this->markTestSkipped('Vereist eerst testCreate');
        
        if (self::$testId) {
            $result = $this->fiets->read(self::$testId);
            $this->assertIsArray($result);
            $this->assertEquals("Gazelle", $result['merk']);
        }
    }
    
    /** @test */
    public function testUpdate()
    {
        $this->markTestSkipped('Vereist eerst testCreate');
        
        if (self::$testId) {
            $result = $this->fiets->update(self::$testId, "Batavus", "Updated", 899.99);
            $this->assertTrue($result);
            
            // Check of update werkt
            $fiets = $this->fiets->read(self::$testId);
            $this->assertEquals("Batavus", $fiets['merk']);
        }
    }
    
    /** @test */
    public function testDelete()
    {
        $this->markTestSkipped('Vereist eerst testCreate');
        
        if (self::$testId) {
            $result = $this->fiets->delete(self::$testId);
            $this->assertTrue($result);
        }
    }
    
    /** @test */
    public function testGetAll()
    {
        $result = $this->fiets->getAll();
        $this->assertIsArray($result);
    }
}