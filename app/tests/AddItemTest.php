<?php

class AddItemTest extends TestCase
{
	protected $useDatabase = true;
	
	public function testAddItemWithMissedData(){
		$this->assertFalse(([
                    'itemName' => 'laptop',
                    'price' => '20000.50',
					'quantity' => '10',
					'description' => 'describe',
					'categoryName' => 'wrongcategory'
        ]));
        
	}

}