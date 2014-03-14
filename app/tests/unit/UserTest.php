<<<<<<< HEAD
<?php

class UserTest extends TestCase {

    protected $useDatabase = true;

     /**
     * Tests find() function with valid id
     * It returns its attributes.
     */
    public function testFind() {
        Auth::attempt($this->adminCredentials);
        $id = 1;
        $users = new UserRepository;
        $attributes = $users->find($id);
        $this->assertEquals($attributes['id'],$id);
    }
    
     /**
     * Tests find() function with invalid id
     * It returns null.
     */
    public function testFindWithInvalidId() {
        Auth::attempt($this->adminCredentials);
        $id = -2;
        $users = new UserRepository;
        $attributes = $users->find($id);
        $this->assertNull($attributes);
    }
        
    /**
     * Tests add() function with valid data
     * and admin currently logged in.
     * The function should return the id of the created user.
     */
    public function testAdd() {
        Auth::attempt($this->adminCredentials);

        $userData = [
            'username' => 'clerk3',
            'password' => 'clerk3_password'
        ];
        $users = new UserRepository;
        $id = $users->add($userData);
        $attributes = $users->find($id);
        $this->assertEquals($attributes['username'], $userData['username']);
    }

    /**
     * Tests add() function with invalid data
     * and admin currently logged in.
     * @expectedException ErrorException 
     */
    public function testAddWithInvalidData() {
        Auth::attempt($this->adminCredentials);

        $userData = [
            'username' => 'clerk1',
            'password' => 'clerk1_password'
        ];
        $users = new UserRepository;
        $users->add($userData);
    }

    /**
     * Tests add() function with valid data
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testAddWithUnauthorizedUser() {
        Auth::attempt($this->clerkCredentials);

        $userData = [
            'username' => 'clerk4',
            'password' => 'clerk4_password'
        ];

        $users = new UserRepository;
        $id = $users->add($userData);
        $users->find($id);
    }

    /**
     * Tests delete() function with valid id
     * and admin currently logged in.
     * When user with the specified id is searched
     * in the database, none is found.
     */
    public function testDelete() {
        Auth::attempt($this->adminCredentials);
        $id = 1;
        $users = new UserRepository;
        $this->assertNotNull($users->find($id));
        $users->delete($id);
        $this->assertNull($users->find($id));
    }
    
     /**
     * Tests delete() function with invalid id
     * and admin currently logged in.
     * The function should throw ErrorException.
     * @expectedException ErrorException
     */
    public function testDeleteWithInvalidId() {
        Auth::attempt($this->adminCredentials);
        $id = -2;
        $users = new UserRepository;
        $users->delete($id);
    }
    
    /**
     * Tests delete() function with valid id
     * and admin currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testDeleteWithUnauthorizedUser() {
        Auth::attempt($this->auditorCredentials);
        $id = 3;
        $users = new UserRepository;
        $this->assertNotNull($users->find($id));
        $users->delete($id);
        $this->assertNotNull($users->find($id));
    }
    
     /**
     * Tests edit() function with valid id
     * and admin currently logged in.
     * When item category with the specified id is searched
     * it should return the new attribute(s).
     */
    public function testEdit() {
        Auth::attempt($this->adminCredentials);
        $id = 2;
        $data = ['password' => 'password'];
        $users = new UserRepository;
        $this->assertNotNull($users->find($id));
        $users->edit($id,$data);
        $attributes = $users->find($id);
        //$this->assertTrue(Hash::matches($data['password'],$attributes['password']));
    }

    
     /**
     * Tests edit() function with invalid id
     * and admin currently logged in.
     * The function should throw ErrorException.
     * @expectedException ErrorException
     */
    public function testEditWithInvalidData() {
        Auth::attempt($this->adminCredentials);
        $id = 2;
        $data = ['username' => 342];
        $users = new UserRepository;
        $this->assertNotNull($users->find($id));
        $users->edit($id,$data);
    }
    
    /**
     * Tests edit() function with valid id
     * and admin currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testEditWithUnauthorizedUser() {
        Auth::attempt($this->clerkCredentials);
        $id = 1;
        $data = ['password' => 'hacked'];
        $users = new UserRepository;
        $this->assertNotNull($users->find($id));
        $users->edit($id,$data);
    }
}
=======
<?php

class UserTest extends TestCase {

    protected $useDatabase = true;

     /**
     * Tests find() function with valid id
     * It returns its attributes.
     */
    public function testFind() {
        Auth::attempt($this->adminCredentials);
        $id = 1;
        $users = new UserRepository;
        $attributes = $users->find($id);
        $this->assertEquals($attributes['id'],$id);
    }
    
     /**
     * Tests find() function with invalid id
     * It returns null.
     */
    public function testFindWithInvalidId() {
        Auth::attempt($this->adminCredentials);
        $id = -2;
        $users = new UserRepository;
        $attributes = $users->find($id);
        $this->assertNull($attributes);
    }
        
    /**
     * Tests add() function with valid data
     * and admin currently logged in.
     * The function should return the id of the created user.
     */
    public function testAdd() {
        Auth::attempt($this->adminCredentials);

        $userData = [
            'username' => 'clerk3',
            'password' => 'clerk3_password'
        ];
        $users = new UserRepository;
        $id = $users->add($userData);
        $attributes = $users->find($id);
        $this->assertEquals($attributes['username'], $userData['username']);
    }

    /**
     * Tests add() function with invalid data
     * and admin currently logged in.
     * @expectedException ErrorException 
     */
    public function testAddWithInvalidData() {
        Auth::attempt($this->adminCredentials);

        $userData = [
            'username' => 'clerk1',
            'password' => 'clerk1_password'
        ];
        $users = new UserRepository;
        $users->add($userData);
    }

    /**
     * Tests add() function with valid data
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testAddWithUnauthorizedUser() {
        Auth::attempt($this->clerkCredentials);

        $userData = [
            'username' => 'clerk4',
            'password' => 'clerk4_password'
        ];

        $users = new UserRepository;
        $id = $users->add($userData);
        $users->find($id);
    }

    /**
     * Tests delete() function with valid id
     * and admin currently logged in.
     * When user with the specified id is searched
     * in the database, none is found.
     */
    public function testDelete() {
        Auth::attempt($this->adminCredentials);
        $id = 1;
        $users = new UserRepository;
        $this->assertNotNull($users->find($id));
        $users->delete($id);
        $this->assertNull($users->find($id));
    }
    
     /**
     * Tests delete() function with invalid id
     * and admin currently logged in.
     * The function should throw ErrorException.
     * @expectedException ErrorException
     */
    public function testDeleteWithInvalidId() {
        Auth::attempt($this->adminCredentials);
        $id = -2;
        $users = new UserRepository;
        $users->delete($id);
    }
    
    /**
     * Tests delete() function with valid id
     * and admin currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testDeleteWithUnauthorizedUser() {
        Auth::attempt($this->auditorCredentials);
        $id = 3;
        $users = new UserRepository;
        $this->assertNotNull($users->find($id));
        $users->delete($id);
        $this->assertNotNull($users->find($id));
    }
    
     /**
     * Tests edit() function with valid id
     * and admin currently logged in.
     * When item category with the specified id is searched
     * it should return the new attribute(s).
     */
    public function testEdit() {
        Auth::attempt($this->adminCredentials);
        $id = 2;
        $data = ['password' => 'password'];
        $users = new UserRepository;
        $this->assertNotNull($users->find($id));
        $users->edit($id,$data);
        $attributes = $users->find($id);
        //$this->assertTrue(Hash::matches($data['password'],$attributes['password']));
    }

    
     /**
     * Tests edit() function with invalid id
     * and admin currently logged in.
     * The function should throw ErrorException.
     * @expectedException ErrorException
     */
    public function testEditWithInvalidData() {
        Auth::attempt($this->adminCredentials);
        $id = 2;
        $data = ['username' => 342];
        $users = new UserRepository;
        $this->assertNotNull($users->find($id));
        $users->edit($id,$data);
    }
    
    /**
     * Tests edit() function with valid id
     * and admin currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testEditWithUnauthorizedUser() {
        Auth::attempt($this->clerkCredentials);
        $id = 1;
        $data = ['password' => 'hacked'];
        $users = new UserRepository;
        $this->assertNotNull($users->find($id));
        $users->edit($id,$data);
    }
}
>>>>>>> ae03d50db3eb5abee30f2fa345878b2c78ab8baf
