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
     * The function should throw an ErrorException.
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
     * Tests createItemCategory() function with valid data
     * and no user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testCreateItemCategoryWithNoUser() {
        $categoryData = [
            'name' => 'Vegetables',
            'description' => 'cabbage, lettuce, cucumber, carrots, tomatoes, etc'
        ];

        Inventory::createItemCategory($categoryData);
    }

    /**
     * Tests removeItemCategory() function with valid category id
     * and authorized user currently logged in.
     * When item category with the specified id is searched
     * in the database, none is found.
     */
    public function testRemoveItemCategoryWithValidId() {
        Auth::attempt($this->auditorCredentials);
        $categoryId = 1;
        $this->assertNotNull(ItemCategory::find($categoryId));
        Inventory::removeItemCategory($categoryId);
        $this->assertNull(ItemCategory::find($categoryId));
    }
    
    /**
     * Tests removeItemCategory() function with invalid category id
     * and authorized user currently logged in.
     * The function should throw ErrorException.
     * @expectedException ErrorException
     */
    public function testRemoveItemCategoryWithInvalidId() {
        Auth::attempt($this->adminCredentials);
        $categoryId = bdf;
        $this->assertNotNull(ItemCategory::find($categoryId));
        Inventory::removeItemCategory($categoryId);
    }
    
    /**
     * Tests removeItemCategory() function with valid category id
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testRemoveItemCategoryWithUnauthorizedUser() {
        Auth::attempt($this->clerkCredentials);
        $categoryId = 2;
        $this->assertNotNull(ItemCategory::find($categoryId));
        Inventory::removeItemCategory($categoryId);
    }

     /**
     * Tests removeItemCategory() function with valid category id
     * and no user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testRemoveItemCategoryWithNoUser() {
        $categoryId = 2;
        $this->assertNotNull(ItemCategory::find($categoryId));
        Inventory::removeItemCategory($categoryId);
    }

}
