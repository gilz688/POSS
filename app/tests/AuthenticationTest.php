<?php

class AuthenticationTest extends TestCase
{
    /**
     * Tests login with invalid username or password.
     * The function returns false.
     */
    public function testLoginWithInvalidCredentials(){
        $this->assertFalse(Auth::attempt([
                    'username' => 'admin',
                    'password' => 'wrongpass'
        ]));
        
        $this->assertFalse(Auth::attempt([
                    'username' => 'wronguser',
                    'password' => 'password'
        ]));
    }
	
    /**
     * Tests login with valid username and password.
     * The function returns true.
     */
    public function testLoginWithValidCredentials(){
        $this->assertTrue(Auth::attempt([
                    'username' => 'admin',
                    'password' => 'password'
        ]));
    }
	
    /**
     * Tests the login method with invalid arguments.
     * @expectedException ErrorException
     */
    public function testLoginWithInvalidArguments(){
        Auth::attempt([
                    'username' => admin,
                    'password' => 'password'
        ]);
    }
    
     /** Tests the logout method with User logged in.
      *  The function returns true.
      */
    public function testLogoutWithUserLoggedIn(){
        Auth::attempt([
                    'username' => 'admin',
                    'password' => 'password'
        ]);
        $this->assertTrue(Auth::check());
        Auth::logout();
        $this->assertFalse(Auth::check());
    }
	
    /**
     * Tests the logout method with user not logged in.
     * The function returns false.
     */
    public function testLogoutWithUserNotLoggedIn(){
        $this->assertFalse(Auth::check());
        Auth::logout();
        $this->assertFalse(Auth::check());
    }
}
