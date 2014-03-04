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
        $this->assertTrue(array_key_exists('quantity', $attributes));
        $this->assertTrue(array_key_exists('price', $attributes));
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
			'barcode' => 52000324822,
			'quantity' => 50,
			'price' => 25.00
		];
		
		$inventoryItems = new InventoryItemRepository;
		$ba = $inventoryItems->add($inventoryData);
		$attributes = $inventoryItems->find($inventoryData['barcode']);
		$this->assertEquals($attributes['barcode'], $inventoryData['barcode']);
		$this->assertEquals($attributes['quantity'], $inventoryData['quantity']);
		$this->assertEquals($attributes['price'], $inventoryData['price']);
	}
	
	/*
	 * Test add() function with invalid data
	 * and authorized user currently logged in.
	 * The function should throw ErrorException
	 * @expectedException ErrorException
	*/
	public function testAddWithInvalidData() {
		Auth::attempt($this->adminCredentials);
		
		$inventoryData = [
			'barcode' => 5200032482,
			'quantity' => -50,
			'price' => -25.00
		];
		
		$inventoryItems = new InventoryItemRepository;
		$barcode = $inventoryItems->add($inventoryData);
	}
	
	/*
	 * Test add() function with valid data
	 * and unauthorized user currently logged in.
	 * The function should throw UnauthorizedException.
	 * @expectedException UnauthorizedException
	*/
	public function testAddWithUnauthorizedUser() {
		Auth::attempt($this->clerkCredentials);
		
		$inventoryData = [
			'barcode' => 52000324822,
			'quantity' => 50,
			'price' => 25.00
		];
		
		$inventoryItems = new InventoryItemRepository;
		$barcode = $inventoryItems->add($inventoryData);
		$attributes = $inventoryItems->find($barcode);
	}
	
	/*
	 * Tests delete() function with valid id
	 * and authorized user currently logged in.
	 * When inventory item with the specified barcode is searched
	 * in the database, none is found
	*/
	public function testDeleteWithValidData() {
		Auth::attempt($this->adminCredentials);
		
		$barcode= 5011321361058;
		
		$inventoryItems = new InventoryItemRepository;
		$this->assertNotNull($inventoryItems->find($barcode));
		$inventoryItems->delete($barcode);
		$this->assertNull($inventoryItems->find($barcode));
	}
	
	/*
     * Tests delete() function with invalid barcode
     * and authorized user currently logged in.
     * The function should throw ErrorException.
     * @expectedException ErrorException
    */
	public function testDeleteWithInvalidData() {
		Auth::attempt($this->adminCredentials);
		
		$barcode = -5011321361058;
		
		$inventoryItems = new InventoryItemRepository;
		$inventoryItems->delete($barcode);
	} 
	
	/*
     * Tests delete() function with valid barcode
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
    */
	public function testDeleteWithUnauthorizedUser() {
		Auth::attempt($this->auditorCredentials);
		
		$barcode = 5011321361058;
		
		$inventoryItems = new InventoryItemRepository;
		$inventoryItems->delete($barcode);
		$this->assertNotNull($inventoryItems->find($barcode));
	}
	
	/*
     * Tests edit() function with valid data
     * and authorized user currently logged in.
     * When item category with the specified id is searched
     * it should return the new attribute(s).
    */
	public function testEditWithValidData() {
		Auth::attempt($this->adminCredentials);
		
		$barcode = 5011321361058;
		
		$data = [
			'quantity' => 100
		];
		
		$inventoryItems = new InventoryItemRepository;
		$this->assertNotNull($inventoryItems->find($barcode));
		$inventoryItems->edit($barcode,$data);
		$attributes = $inventoryItems->find($barcode);
		$this->assertEquals($data['quantity'],$attributes['quantity']);
	}
	
	/*
     * Tests edit() function with invalid data
     * and authorized user currently logged in.
     * The function should throw ErrorException.
     * @expectedException ErrorException
    */
	public function testEditWithInvalidData() {
		Auth::attempt($this->adminCredentials);
		
		$barcode = 5011321361058;
		
		$data = [
			'quantity' => 'one hundred'
		];
		
		$inventoryItems = new InventoryItemRepository;
		$this->assertNotNull($inventoryItems->find($barcode));
		$inventoryItems->edit($barcode, $data);
	}
	
	/*
     * Tests edit() function with valid data
     * and unauthorized user currently logged in.
     * When item category with the specified id is searched
     * it should return the new attribute(s).
    */
	public function testEditWithUnauthorizedUser() {
		Auth::attempt($this->clerkCredentials);
		
		$barcode = 5011321361058;
		
		$data = [
			'quantity' => 100
		];
		
		$inventoryItems = new InventoryItemRepository;
		$this->assertNotNull($inventoryItems->find($barcode));
		$inventoryItems->edit($barcode,$data);
		$attributes = $inventoryItems->find($barcode);
		$this->assertEquals($data['quantity'],$attributes['quantity']);
	}
	
}




