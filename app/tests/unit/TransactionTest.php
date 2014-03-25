<?php
use Carbon\Carbon;
class TransactionTest extends TestCase {

    protected $useDatabase = true;

    /**
     * Tests find() function with valid id
     * and an auditor currently logged in.
     * It returns its attributes.
     */
    public function testFindWithAuditor() {
        Auth::attempt($this->auditorCredentials);
        $id = 2;
        $transactions = new TransactionRepository();
        $attributes = $transactions->find($id);
        $this->assertEquals($attributes['id'], $id);
        $this->assertTrue(array_key_exists('cashier_number', $attributes));
        $this->assertTrue(array_key_exists('creator_id', $attributes));
    }
    
    /**
     * Tests find() function with valid id
     * and an clerk currently logged in.
     * It returns its attributes.
     */
    public function testFindWithClerk() {
        Auth::attempt($this->clerkCredentials);
        $id = 1;
        $transactions = new TransactionRepository();
        $attributes = $transactions->find($id);
        $this->assertEquals($attributes['id'], $id);
        $this->assertTrue(array_key_exists('cashier_number', $attributes));
        $this->assertTrue(array_key_exists('creator_id', $attributes));
    }

    /**
     * Tests find() function with invalid id.
     * and a clerk currently logged in.
     * It returns null.
     */
    public function testFindWithInvalidIdandClerkLoggedIn() {
        Auth::attempt($this->clerkCredentials);
        $id = -2;
        $transactions = new TransactionRepository();
        $attributes = $transactions->find($id);
        $this->assertNull($attributes);
    }

    /**
     * Tests find() function with invalid id.
     * and a auditor currently logged in.
     * It returns null.
     */
    public function testFindWithInvalidIdAuditorLoggedIn() {
        Auth::attempt($this->auditorCredentials);
        $id = -2;
        $transactions = new TransactionRepository();
        $attributes = $transactions->find($id);
        $this->assertNull($attributes);
    }

    /**
     * Tests find() function with a transaction created
     * by another clerk.
     * It returns UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testFindWithTransactionByAnotherClerk() {
        Auth::attempt($this->clerkCredentials);
        $id = 3;
        $transactions = new TransactionRepository();
        $attributes = $transactions->find($id);
        $this->assertNull($attributes);
    }

    /**
     * Tests add() function with valid data
     * and authorized user currently logged in.
     * The function should return the id of the created transaction.
     */
    public function testAdd() {
        Auth::attempt($this->clerkCredentials);

        $categoryData = [
            'cashier_number' => 2,
        ];

        $transactions = new TransactionRepository();
        $id = $transactions->add($categoryData);

        $attributes = $transactions->find($id);
        $this->assertNotNull($attributes);
        $this->assertEquals($attributes['cashier_number'], 2);
        $this->assertEquals($attributes['creator_id'], Auth::user()->id);
    }

    /**
     * Tests add() function with invalid data
     * and authorized user currently logged in.
     * The function should return the id of the created item category.
     * @expectedException ErrorException 
     */
    public function testAddWithInvalidData() {
        Auth::attempt($this->clerkCredentials);

        $categoryData = [
            'cashier_number' => asd,
        ];

        $transactions = new TransactionRepository();
        $transactions->add($categoryData);
    }

    /**
     * Tests add() function with valid data
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testAddWithUnauthorizedUser() {
        Auth::attempt($this->auditorCredentials);

        $categoryData = [
            'cashier_number' => 2,
        ];

        $transactions = new TransactionRepository();
        $transactions->add($categoryData);
    }

    /**
     * Tests delete() function with valid id
     * and authorized user currently logged in.
     * When item category with the specified id is searched
     * in the database, none is found.
     */
    public function testDelete() {
        Auth::attempt($this->auditorCredentials);
        $id = 2;
        $transactions = new TransactionRepository();
        $this->assertNotNull($transactions->find($id));
        $transactions->delete($id);
        $this->assertNull($transactions->find($id));
    }

    /**
     * Tests delete() function with invalid id
     * and authorized user currently logged in.
     * The function should throw ErrorException.
     * @expectedException ErrorException
     */
    public function testDeleteWithInvalidId() {
        Auth::attempt($this->auditorCredentials);
        $id = -31;
        $transactions = new TransactionRepository();
        $this->assertNull($transactions->find($id));
        $transactions->delete($id);
    }

    /**
     * Tests delete() function with valid id
     * and unauthorized user currently logged in.
     * The function should throw UnauthorizedException.
     * @expectedException UnauthorizedException
     */
    public function testDeleteWithUnauthorizedUser() {
        Auth::attempt($this->clerkCredentials);
        $id = 1;
        $transactions = new TransactionRepository();
        $this->assertNotNull($transactions->find($id));
        $transactions->delete($id);
        $this->assertNull($transactions->find($id));
    }

    /**
     * Tests edit() function with valid id
     * and authorized user currently logged in.
     * The function should throw IllegalOperationException.
     * @expectedException IllegalOperationException
     */
    public function testEdit() {
        Auth::attempt($this->auditorCredentials);
        $id = 2;
        $data = ['cashier_number' => 3];
        $transactions = new TransactionRepository();
        $this->assertNotNull($transactions->find($id));
        $transactions->edit($id, $data);
    }


    /**
     * Tests get() function with valid parameters
     * and authorized user currently logged in.
     */
    public function testGet() {
        Auth::attempt($this->auditorCredentials);
        $start = Carbon::createFromFormat('Y-m-d H:i:s', '2014-03-20 8:00:00');
        $end = Carbon::createFromFormat('Y-m-d H:i:s', '2014-03-21 18:00:00');
        $repo = new TransactionRepository;
        $transactions = $repo->get($start,$end);
        $this->assertEquals(count($transactions),3);
    }
}
