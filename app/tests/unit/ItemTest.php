<?php

class ItemTest extends TestCase {

     protected $useDatabase = true;

     /**
     * Tests find() function with valid barcode
     * It returns its attributes.
     */
    public function testFind() {
        Auth::attempt($this->clerkCredentials);
        $barcode = 1428500365641;
        $items = new ItemRepository;
        $attributes = $items->find($barcode);
        $this->assertEquals($attributes['barcode'],$barcode);
        $this->assertTrue(array_key_exists('itemName', $attributes));
		$this->assertTrue(array_key_exists('price', $attributes));
		$this->assertTrue(array_key_exists('quantity', $attributes));
        $this->assertTrue(array_key_exists('itemDescription', $attributes));
		$this->assertTrue(array_key_exists('label', $attributes));
		$this->assertTrue(array_key_exists('category_id', $attributes));
    }
    
	
     /**
     * Tests find() function with invalid barcode
     * It returns null.
     */
    public function testFindWithInvalidBarcode() {
        Auth::attempt($this->clerkCredentials);
        $barcode = 92910389213;
        $items = new ItemRepository;
        $attributes = $items->find($barcode);
        $this->assertNull($attributes);
    }
        
    /**
     * Tests add() function with valid data
     * and authorized user currently logged in.
     * The function should return the barcode of the created item .
     */
    public function testAdd() {
        Auth::attempt($this->adminCredentials);

        $itemData = [
			'barcode' => 1200032458813,
            'itemName' => 'Mineral Water',
			'price' => 15.25,
			'quantity' => 10,
            'itemDescription' => 'water, beverages,',
			'label' => '500mL',
			'category_id' => 3,
        ];
        $items = new ItemRepository;
        $barcode = $items->add($itemData);
        $attributes = $items->find($barcode);
        $this->assertEquals($attributes['itemName'], $itemData['itemName']);
		$this->assertEquals($attributes['price'], $itemData['price']);
		$this->assertEquals($attributes['quantity'], $itemData['quantity']);
        $this->assertEquals($attributes['itemDescription'], $itemData['itemDescription']);
		$this->assertEquals($attributes['label'], $itemData['label']);
		$this->assertEquals($attributes['category_id'], $itemData['category_id']);
    }

    /**
     * Tests add() function with invalid data
     * and authorized user currently logged in.
     * The function should return the barcode of the created item .
     * @expectedException ErrorException 
     */
    public function testAddWithInvalidData() {
        Auth::attempt($this->adminCredentials);

        $categoryData = [
			'barcode' => 1200032458813,
            'itemName' => 'Mineral Water',
			'price' => 15.25,
			'quantity' => 5,
            'itemDescription' => shampoo, conditioners, lotions, perfumes, etc,
			'label' => '500mL',
			'category_id' => 3,
        ];

        $items = new ItemRepository;
        $barcode = $items->add($itemData);
    }

    /**
     * Tests add() function with valid data
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testAddWithUnauthorizedUser() {
        Auth::attempt($this->clerkCredentials);

        $itemData = [
            'barcode' => 8944032458812,
            'itemName' => 'Canned Sardines',
			'price' => 13.25,
			'quantity' => 5,
            'itemDescription' => 'Mega Sardines',
			'label' => '170g',
			'category_id' => 5,
        ];

        $items = new ItemRepository;
        $barcode = $items->add($itemData);
        $attributes = $items->find($barcode);
    }
	
	/**
     * Tests delete() function with valid barcode
     * and authorized user currently logged in.
     * When item category with the specified barcode is searched
     * in the database, none is found.
     */
    public function testDelete() {
        Auth::attempt($this->adminCredentials);
        $barcode = 4800088145053;
        $items = new ItemRepository;
        $this->assertNotNull($items->find($barcode));
        $items->delete($barcode);
        $this->assertNull($items->find($barcode));
    }
    
     /**
     * Tests delete() function with invalid barcode
     * and authorized user currently logged in.
     * The function should throw ErrorException.
     * @expectedException ErrorException
     */
    public function testDeleteWithInvalidBarcode() {
        Auth::attempt($this->adminCredentials);
        $barcode = -192104883;
        $items = new ItemRepository;
        $items->delete($barcode);
    }
    
    /**
     * Tests delete() function with valid barocde
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testDeleteWithUnauthorizedUser() {
        Auth::attempt($this->auditorCredentials);
        $barcode = 4800088145053;
        $items = new ItemRepository;
        $this->assertNotNull($items->find($barcode));
        $items->delete($barcode);
        $this->assertNotNull($items->find($barcode));
    }
    
     /**
     * Tests edit() function with valid barcode
     * and authorized user currently logged in.
     * When item with the specified barcode is searched
     * it should return the new attribute(s).
     */
    public function testEdit() {
        Auth::attempt($this->adminCredentials);
        $barcode = 5011321361058;
        $data = ['price' => 31.25];
        $items = new ItemRepository;
        $this->assertNotNull($items->find($barcode));
        $items->edit($barcode,$data);
        $attributes = $items->find($barcode);
        $this->assertEquals($data['price'],$attributes['price']);
    }

     /**
     * Tests edit() function with invalid barcode
     * and authorized user currently logged in.
     * The function should throw ErrorException.
     * @expectedException ErrorException
     */
    public function testEditWithInvalidData() {
        Auth::attempt($this->adminCredentials);
        $barcode = -5011321361058;
        $data = ['price' => 342.768];
        $items = new ItemRepository;
        $this->assertNotNull($items->find($barcode));
        $items->edit($barcode,$data);
    }
    
    /**
     * Tests edit() function with valid barcode
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testEditWithUnauthorizedUser() {
        Auth::attempt($this->clerkCredentials);
        $barcode = 5011321361058;
        $data = ['price' => 5.25];
        $items = new ItemRepository;
        $this->assertNotNull($items->find($barcode));
        $items->edit($barcode,$data);
    }
}
