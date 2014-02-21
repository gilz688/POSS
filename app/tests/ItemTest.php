<?php

class ItemTest extends TestCase {

    protected $useDatabase = true;

    /**
     * Tests createItem() function with valid data
     * and authorized user currently logged in.
     * The function should return the barcode of the created item .
     */
    public function testCreateItemWithValidData() {
        Auth::attempt($this->adminCredentials);

        $itemData = [
			'barcode' => 800552999632,
            'name' => 'Body Spray',
			'price' => 150.25, 
            'description' => 'Ever Bilena body spray',
			'size_or_weight' => '100mL',
            'category_id' => 10
			
        ];

        $itemBarcode = Inventory::createItem($itemData);
        $item = Item::find($itemBarcode);
		$item->assertEquals($item->barcode, $itemData['barcode']);
        $this->assertEquals($item->name, $itemData['name']);
		$this->assertEquals($item->price, $itemData['price']);
        $this->assertEquals($item->description, $itemData['description']);
		$this->assertEquals($item->size_or_weight, $itemData['size_or_weight']);
		$this->assertEquals($item->category_id, $itemData['category_id']);
    }

    /**
     * Tests create() function with invalid data
     * and authorized user currently logged in.
     * The function should throw an ErrorException.
     * @expectedException ErrorException 
     */
    public function testCreateItemWithInvalidData() {
        Auth::attempt($this->auditorCredentials);

        $itemData = [
           'barcode' => 800552999632,
            'name' => Body Spray,
			'price' => 150.25, 
            'description' => 'Ever Bilena body spray',
			'size_or_weight' => '100mL',
            'category_id' => 10
        ];

        Item::createItem($itemData);
    }

    /**
     * Tests createItem() function with valid data
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testCreateItemWithUnauthorizedUser() {
        Auth::attempt($this->clerkCredentials);

        $itemData = [
            'barcode' => 067712190335,
            'name' => 'Canned Sardines',
			'price' => 30.25, 
            'description' => 'Mega Sardines',
			'size_or_weight' => '120g',
            'category_id' => 5
        ];

        Item::createItem($itemData);
    }
    
     /**
     * Tests createItem() function with valid data
     * and no user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testCreateItemWithNoUser() {
        $itemData = [
            'barcode' => 067712190335,
            'name' => 'Canned Sardines',
			'price' => 30.25, 
            'description' => 'Mega Sardines',
			'size_or_weight' => '120g',
            'category_id' => 5
        ];

        Item::createItem($itemData);
    }

    /**
     * Tests removeItem() function with valid item barcode
     * and authorized user currently logged in.
     * When item  with the specified barcode is searched
     * in the database, none is found.
     */
    public function testRemoveItemWithValidBarcode() {
        Auth::attempt($this->adminCredentials);
        $itemBarcode = 800552999632;
        $this->assertNotNull(Item::find($itemBarcode));
        Item::removeItem($itemBarcode);
        $this->assertNull(Item::find($itemBarcode));
    }
    
    /**
     * Tests removeItem() function with invalid item barcode
     * and authorized user currently logged in.
     * The function should throw ErrorException.
     * @expectedException ErrorException
     */
    public function testRemoveItemWithInvalidBarcode() {
        Auth::attempt($this->adminCredentials);
        $itemBarcode = asdhd;
        $this->assertNotNull(Item::find($itemBarcode));
        Item::removeItem($itemBarcode);
    }
    
    /**
     * Tests removeItem() function with valid item barcode
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testRemoveItemCategoryWithUnauthorizedUser() {
        Auth::attempt($this->clerkCredentials);
        $itemBarcode = 052000324822;
        $this->assertNotNull(Item::find($itemBarcode));
        Item::removeItem$itemBarcode);
    }

     /**
     * Tests removeItem() function with valid item barcode
     * and no user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testRemoveItemCategoryWithNoUser() {
        $itemBarcode = 052000324822;
        $this->assertNotNull(Item::find($itemBarcode));
        Item::removeItem($itemBarcode);
    }

}
