<?php

class AdministrationTest extends TestCase{
    protected $useDatabase = true;
    
     /**
     * Tests createUser() function with valid data
     * with authorized user currently logged in.
     * The function should return the id of the created user.
     */
    public function testCreateUserWithValidData(){
        Auth::attempt($this->adminCredentials);
        
        $userData = [
            'username' => 'new_clerk1',
            'password' => 'new_clerk1_password'
        ];
        
        $userId = Administration::createUser($userData);
        $user = User::find($userId);
        $this->assertEquals($user->username,$userData['username']); 
        $this->assertTrue(Hash::check($userData['password'], $user->password));
    }
    
     /**
     * Tests createUser() function with invalid data.
     * The function should throw an ErrorException.
     * @expectedException ErrorException 
     */
    public function testCreateUserWithInvalidData(){
        Auth::attempt($this->adminCredentials);
        
        $userData = [
            'username' => new_clerk,
            password => 'new_clerk_password'
        ];
        
        Administration::createUser($userData);
    }
    
     /**
     * Tests createUser() with blank data.
     * The function should throw an ErrorException.
     * @expectedException ErrorException 
     */
    public function testCreateUserWithBlankData(){
        Auth::attempt($this->adminCredentials);
        
        $userData = [];
        
        Administration::createUser($userData);
    }
    
        
     /**
     * Tests createUser() with an unauthorized user.
     * The function should throw an UnauthorizedException.
     * @expectedException UnauthorizedException 
     */
    public function testCreateUserWithUnauthorizedUser(){
        Auth::attempt($this->clerkCredentials);
        
        $userData = [
            'username' => 'new_clerk2',
            'password' => 'new_clerk2_password'
        ];
        
        Administration::createUser($userData);
    }
    
     /**
     * Tests createUser() with no user logged in.
     * The function should throw an UnauthorizedException.
     * @expectedException UnauthorizedException 
     */
    public function testCreateUserWithNoUserLoggedIn(){
        $userData = [
            'username' => 'new_clerk',
            'password' => 'new_clerk2_password'
        ];
        
        Administration::createUser($userData);
    }
    
     /**
     * Tests removeUser() function with valid id
     * with authorized user currently logged in.
     * When user with the specified id is searched
     * in the database, none is found.
     */
    public function testRemoveUserWithValidId(){
        Auth::attempt($this->adminCredentials);
        
        $userData = [
            'username' => 'dummy_auditor',
            'password' => 'dummy_auditor_password',
            'role' => 'auditor'
        ];
        
        $userId = Administration::createUser($userData);
        $this->assertNotNull(User::find($userId));
        Administration::removeUser($userId);
        $this->assertNull(User::find($userId));
    }
    
     /**
     * Tests removeUser() function with invalid id.
     * The function should throw an ErrorException.
     * @expectedException ErrorException 
     */
    public function testRemoveUserWithInvalidId(){
        Auth::attempt($this->adminCredentials);
        $userId = 'asd';
        $this->assertNull(User::find($userId));
        Administration::removeUser($userId);
    }
    
     /**
     * Tests removeUser() function with non-existing id.
     * The function should throw an ErrorException.
     * @expectedException ErrorException 
     */
    public function testRemoveUserWithNonExistingId(){
        Auth::attempt($this->adminCredentials);
        $userId = 500;
        $this->assertNull(User::find($userId));
        Administration::removeUser($userId);
    }
    
     /**
     * Tests removeUser() function with valid id but with
     * user not currently logged in as admin.
     * The function should throw an UnauthorizedException.
     * @expectedException UnauthorizedException 
     */
    public function testRemoveUserWithUnauthorizedUser(){
        Auth::attempt($this->adminCredentials);
        $userData = [
            'username' => 'dummy_auditor',
            'password' => 'dummy_auditor_password',
            'role' => 'auditor'
        ];
        $userId = Administration::createUser($userData);
        
        // as clerk
        Auth::attempt($this->clerkCredentials);
        Administration::removeUser($userId);
        
        // as auditor
        Auth::attempt($this->auditorCredentials);
        Administration::removeUser($userId);
        
        // check if user was not deleted by clerk or auditor
        $this->assertNotNull(User::find($userId));
    }
    
     /**
     * Tests removeUser() function with valid id but with
     * no user currently logged in.
     * The function should throw an UnauthorizedException.
     * @expectedException UnauthorizedException 
     */
    public function testRemoveUserWithNoUser(){
        Auth::attempt($this->adminCredentials);
        $userData = [
            'username' => 'dummy_auditor',
            'password' => 'dummy_auditor_password',
            'role' => 'auditor'
        ];
        
        $userId = Administration::createUser($userData);
        $this->assertNotNull(User::find($userId));
        
        Auth::logout();
        Administration::removeUser($userId);
    }
}