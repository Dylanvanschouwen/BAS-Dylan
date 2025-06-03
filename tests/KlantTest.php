<?php
// auteur: Dylan van schouwen
// functie: unitests class klant

use PHPUnit\Framework\TestCase;
use Bas\classes\klant;

// Filename moet gelijk zijn aan de classname klantTest
class klantTest extends TestCase{
    
	protected $klant;

    protected function setUp(): void {
        $this->klant = new klant();
    }

	// Methods moeten starten met de naam test....
	public function testgetklanten(){
		$klanten = $this->klant->getklanten();
        $this->assertIsArray($klanten);
		$this->assertTrue(count($klanten) > 0, "Aantal moet groter dan 0 zijn");
	}

	public function testGetklant(){
		$klantId = 1; // check of dit ook echt in de database bestaat!
		$klant = $this->klant->getklant($klantId);
		$this->assertEquals($klantId, $klant['klantId']);
	}
	
}
	
?>