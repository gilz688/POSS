<?php

class AuthenticationTest extends TestCase
{
    protected $useDatabase = true;
    
    /**
     * Tests login with invalid username or password.
     * The function should return false.
     */
    public function testLoginWithInvalidCredentials(){
        $this->assertFalse(Auth::attempt([
                    'username' => 'admin1',
                    'password' => 'wrongpass'
        ]));
        
        $this->assertFalse(Auth::attempt([
                    'username' => 'wronguser',
                    'password' => 'admin1_password'
        ]));
    }
	
    /**
     * Tests login with valid username and password.
     * The function should return true.
     */
    public function testLoginWithValidCredentials(){
        $this->assertTrue(Auth::attempt([
                    'username' => 'admin1',
                    'password' => 'admin1_password'
        ]));
    }

     /**
     * Tests the login method with missing arguments.
     * @expectedException ErrorException
     */
    public function testLoginWithMissingArguments(){
        Auth::attempt([
                    'username' => 'admin1'
        ]);
    }
    
    /**
     * Tests the login method with invalid arguments.
     * @expectedException ErrorException
     */
    public function testLoginWithInvalidArguments(){
        Auth::attempt([
                    'username' => admin1,
                    password => 'admin1_password'
        ]);
    }
    
     /** Tests the logout method with User logged in.
      *  The user should be logged out after the method call.
      */
    public function testLogoutWithUserLoggedIn(){
        Auth::attempt([
                    'username' => 'admin1',
                    'password' => 'admin1_password'
        ]);
        $this->assertTrue(Auth::check());
        Auth::logout();
        $this->assertFalse(Auth::check());
    }
	
    /**
     * Tests the logout method with user not logged in.
     * The user must not be logged in before and after the method call.
     */
    public function testLogoutWithUserNotLoggedIn(){
        $this->assertFalse(Auth::check());
        Auth::logout();
        $this->assertFalse(Auth::check());
    }
    
}
