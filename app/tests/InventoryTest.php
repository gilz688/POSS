<?php

class InventoryTest extends TestCase {

    protected $useDatabase = true;

    /**
     * Tests createItemCategory() function with valid data
     * and authorized user currently logged in.
     * The function should return the id of the created item category.
     */
    public function testCreateItemCategoryWithValidData() {
        Auth::attempt($this->auditorCredentials);

        $categoryData = [
            'name' => 'Cosmetics',
            'description' => 'shampoo, conditioners, lotions, perfumes, etc'
        ];

        $categoryId = Inventory::createItemCategory($categoryData);
        $category = ItemCategory::find($categoryId);
        $this->assertEquals($category->name, $categoryData['name']);
        $this->assertEquals($category->description, $categoryData['description']);
    }

    /**
     * Tests createItemCategory() function with invalid data
     * and authorized user currently logged in.
     * The function should return the id of the created item category.
     * @expectedException ErrorException 
     */
    public function testCreateItemCategoryWithInvalidData() {
        Auth::attempt($this->auditorCredentials);

        $categoryData = [
            'name' => Cosmetics,
            'description' => 5
        ];

        Inventory::createItemCategory($categoryData);
    }

    /**
     * Tests createItemCategory() function with valid data
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testCreateItemCategoryWithUnauthorizedUser() {
        Auth::attempt($this->clerkCredentials);

        $categoryData = [
            'name' => 'Vegetables',
            'description' => 'cabbage, lettuce, cucumber, carrots, tomatoes, etc'
        ];

        Inventory::createItemCategory($categoryData);
    }

    /**
     * Tests removeItemCategory() function with valid data
     * and authorized user currently logged in.
     * When item category with the specified id is searched
     * in the database, none is found.
     */
    public function testRemoveItemCategoryWithAuthorizedUser() {
        Auth::attempt($this->auditorCredentials);
        $categoryId = 1;
        $this->assertNotNull(ItemCategory::find($categoryId));
        Inventory::removeItemCategory($categoryId);
        $this->assertNull(ItemCategory::find($categoryId));
    }

    /**
     * Tests createItemCategory() function with valid data
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testRemoveItemCategoryWithUnauthorizedUser() {
        Auth::attempt($this->auditorCredentials);
        $categoryId = 2;
        $this->assertNotNull(ItemCategory::find($categoryId));
        Inventory::removeItemCategory($categoryId);
    }

    /**
     * Tests createItem() function with valid data
     * and authorized user currently logged in.
     * The function should return the barcode of the created item.
     */
    public function testCreateItemWithValidData() {
        Auth::attempt($this->auditorCredentials);

        $itemData = [
            'barcode' => 9300632066162,
            'name' => 'Toothpaste',
            'description' => 'Colgate Fluoride Toothpaste Total',
            'size_or_weight' => '110g'
        ];

        $barcode = Inventory::createItemCategory($itemData);
        $item = ItemCategory::find($barcode);
        assertEquals($item->barcode,$itemData['name']);
        assertEquals($item->description,$itemData['description']);
        assertEquals($item->size_or_weight,$itemData['size_or_weight']);
    }

    /**
     * Tests createItem() function with invalid data
     * and authorized user currently logged in.
     * The function should return the id of the created item category.
     * @expectedException ErrorException  
    */
    public function testCreateItemWithInvalidData(){
        Auth::attempt($this->auditorCredentials);

        $itemData =[
            'barcode' => abnkkbsnpl,
            'name' => 'Shampoo',
            'description' => 'Head & Shoulders Anti-dandruff Shampoo - refreshing',
            'size_or_weight' => '400mL'

        ];

        $barcode = Inventory::createItemCategory($itemData);
        $item = ItemCategory::find($barcode);
        assertEquals($item->barcode,$itemData['name']);
        assertEquals($item->description,$itemData['description']);
        assertEquals($item->size_or_weight,$itemData['size_or_weight']);
    }

}
