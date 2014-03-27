<?php

class ClerkPerformanceTest extends TestCase{

    protected $useDatabase = true;

    /*
     * Tests test() function with valid clerk id
     * and authorized user currently logged in
    */
    public function test() {
        Auth::attempt($this->adminCredentials);
        $creator_id = 2;
        $a = new ClerkPerformance;
        $b = $a->getTran($creator_id);
        $result = $b[0];
        $this->assertEquals($result['sales'], 458.5);
        $this->assertEquals($result['date'], '03-26-2014');
    }

    /**
     * Tests testInvalidId() function with invalid clerk id
     * and authorized user currently logged in.
     * The function should throw ErrorException.
     * @expectedException ErrorException 
     */
    public function testInvalidId() {
        Auth::attempt($this->adminCredentials);
        $creator_id = two;
        $a = new ClerkPerformance;
        $b = $a->getTran($creator_id);
    }

    /**
     * Tests testUnauthorizedUser() function with valid data
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testUnauthorizedUser() {
        Auth::attempt($this->clerkCredentials);
        $creator_id = 2;
        $a = new ClerkPerformance;
        $b = $a->getTran($creator_id);
    }

}
