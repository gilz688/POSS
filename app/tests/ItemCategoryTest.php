<?php

class ItemCategoryTest extends TestCase {

    protected $useDatabase = true;

     /**
     * Tests find() function with valid id
     * It returns its attributes.
     */
    public function testFind() {
        $id = 1;
        $itemCategories = new ItemCategoryRepository;
        $attributes = $itemCategories->find($id);
        $this->assertEquals($attributes['id'],$id);
        $this->assertTrue(array_key_exists('name', $attributes));
        $this->assertTrue(array_key_exists('description', $attributes));
    }
    
     /**
     * Tests find() function with invalid id
     * It returns null.
     */
    public function testFindWithInvalidId() {
        $id = -2;
        $itemCategories = new ItemCategoryRepository;
        $attributes = $itemCategories->find($id);
        $this->assertNull($attributes);
    }
        
    /**
     * Tests add() function with valid data
     * and authorized user currently logged in.
     * The function should return the id of the created item category.
     */
    public function testAdd() {
        Auth::attempt($this->adminCredentials);

        $categoryData = [
            'name' => 'Cosmetics',
            'description' => 'shampoo, conditioners, lotions, perfumes, etc'
        ];
        $itemCategories = new ItemCategoryRepository;
        $id = $itemCategories->add($categoryData);
        $attributes = $itemCategories->find($id);
        $this->assertEquals($attributes['name'], $categoryData['name']);
        $this->assertEquals($attributes['description'], $categoryData['description']);
    }

    /**
     * Tests add() function with invalid data
     * and authorized user currently logged in.
     * The function should return the id of the created item category.
     * @expectedException ErrorException 
     */
    public function testAddWithInvalidData() {
        Auth::attempt($this->adminCredentials);

        $categoryData = [
            'name' => Cosmetics,
            'description' => 5
        ];

        $itemCategories = new ItemCategoryRepository;
        $id = $itemCategories->add($categoryData);
    }

    /**
     * Tests add() function with valid data
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testAddWithUnauthorizedUser() {
        Auth::attempt($this->clerkCredentials);

        $categoryData = [
            'name' => 'Vegetables',
            'description' => 'cabbage, lettuce, cucumber, carrots, tomatoes, etc'
        ];

        $itemCategories = new ItemCategoryRepository;
        $id = $itemCategories->add($categoryData);
        $attributes = $itemCategories->find($id);
    }

    /**
     * Tests delete() function with valid id
     * and authorized user currently logged in.
     * When item category with the specified id is searched
     * in the database, none is found.
     */
    public function testDelete() {
        Auth::attempt($this->adminCredentials);
        $id = 1;
        $itemCategories = new ItemCategoryRepository;
        $this->assertNotNull($itemCategories->find($id));
        $itemCategories->delete($id);
        $this->assertNull($itemCategories->find($id));
    }

    
     /**
     * Tests delete() function with invalid id
     * and authorized user currently logged in.
     * The function should throw ErrorException.
     * @expectedException ErrorException
     */
    public function testDeleteWithInvalidId() {
        Auth::attempt($this->adminCredentials);
        $id = -2;
        $itemCategories = new ItemCategoryRepository;
        $itemCategories->delete($id);
    }
    
    /**
     * Tests delete() function with valid id
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testDeleteWithUnauthorizedUser() {
        Auth::attempt($this->auditorCredentials);
        $id = 3;
        $itemCategories = new ItemCategoryRepository;
        $this->assertNotNull($itemCategories->find($id));
        $itemCategories->delete($id);
        $this->assertNotNull($itemCategories->find($id));
    }
    
     /**
     * Tests edit() function with valid id
     * and authorized user currently logged in.
     * When item category with the specified id is searched
     * it should return the new attribute(s).
     */
    public function testEdit() {
        Auth::attempt($this->adminCredentials);
        $id = 1;
        $data = ['name' => 'Grocery Items'];
        $itemCategories = new ItemCategoryRepository;
        $this->assertNotNull($itemCategories->find($id));
        $itemCategories->edit($id,$data);
        $attributes = $itemCategories->find($id);
        $this->assertEquals($data['name'],$attributes['name']);
    }

    
     /**
     * Tests edit() function with invalid id
     * and authorized user currently logged in.
     * The function should throw ErrorException.
     * @expectedException ErrorException
     */
    public function testEditWithInvalidData() {
        Auth::attempt($this->adminCredentials);
        $id = 1;
        $data = ['name' => 342];
        $itemCategories = new ItemCategoryRepository;
        $this->assertNotNull($itemCategories->find($id));
        $itemCategories->edit($id,$data);
    }
    
    /**
     * Tests edit() function with valid id
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testEditWithUnauthorizedUser() {
        Auth::attempt($this->clerkCredentials);
        $id = 1;
        $data = ['name' => 'Grocery Items 2'];
        $itemCategories = new ItemCategoryRepository;
        $this->assertNotNull($itemCategories->find($id));
        $itemCategories->edit($id,$data);
    }
}
