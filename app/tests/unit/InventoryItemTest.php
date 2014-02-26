<?php

class InventoryItemTest extends TestCase {

	protected $useDatabase = true;
	
	/*
	 * Tests find() function with valid id
	 * It returns its attributes.
	*/
	public function testFind() {
		Auth::attempt($this->clerkCredentials);
		
		$barcode= 5011321361058;
		
		$inventoryItems = new InventoryItemRepository;
		$attributes = $inventoryItems->find($barcode);
		$this->assertEquals($attributes['barcode'],$barcode);
		$this->assertTrue(array_key_exists('name', $attributes));
	}
	
	/**
     * Tests find() function with invalid id
     * It returns null.
     */
    public function testFindWithInvalidData() {
        Auth::attempt($this->clerkCredentials);
        $id = -5011321361058;
        $itemCategories = new InventoryItemRepository;
        $attributes = $itemCategories->find($id);
        $this->assertNull($attributes);
    }

	/*
	 * Test add() function with valid data
	 * and authorized user currently logged in.
	 * The function should return the barcode of the created inventory item.
	*/
	public function testAddWithValidData() {
		Auth::attempt($this->adminCredentials);
		
		$inventoryData = [
			'barcode' => 4800119220803,
			'quantity' => 50,
			'price' => 25.00
		];
		
		$inventoryItems = new InventoryItemRepository;
		$barcode = $inventoryItems->add($inventoryData);
		$attributes = $inventoryItems->find($barcode);
		$this->assertEquals($attributes['barcode'], $inventoryData['barcode']);
		$this->assertEquals($attributes['quantity'], $inventoryData['quantity']);
		$this->assertEquals($attributes['price'], $inventoryData['price']);
	}
	
	public function testAddWithInvalidData() {
		Auth::attempt($this->adminCredentials);
		
		$inventoryData = [
			'barcode' => 4800119220803,
			'quantity' => fifty,
			'price' => 25.00
		];
		
		$inventoryItems = new InventoryItemRepository;
		$barcode = $inventoryItems->add($inventoryData);
	}
	
}









