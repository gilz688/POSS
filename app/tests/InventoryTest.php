<?php

class InventoryTest extends TestCase
{
    protected $useDatabase = true;
	
     /**
     * Tests createItemCategory function with valid data
     * with authorized user currently logged in.
     * The function should return the id of the new item category.
     */
    public function createItemCategoryWithValidData(){
        Auth::attempt($this->auditorCredentials);
        
        $userData = [
            'username' => 'new_clerk1',
            'password' => 'new_clerk1_password'
        ];
        
        $userId = Administration::createUser($userData);
        $user = User::find($userId);
        $this->assertEquals($user->username,$userData['username']); 
        $this->assertTrue(Hash::check($userData['password'], $user->password));
    }
    
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