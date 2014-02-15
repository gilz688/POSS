<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    protected $useDatabase = false;

    /**
     * Valid credentials in the Test Database
     */
    protected $adminCredentials = [
        'username' => 'admin1',
        'password' => 'admin1_password'
    ];
    protected $auditorCredentials = [
        'username' => 'auditor1',
        'password' => 'auditor1_password'       
    ];
    protected $clerkCredentials = [
        'username' => 'clerk1',
        'password' => 'clerk1_password'       
    ];
    
    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication() {
        $unitTesting = true;

        // switches to an in-memory sqlite database for testing purposes
        $testEnvironment = 'testing';

        return require __DIR__ . '/../../bootstrap/start.php';
    }

    /**
     * Default preparation for each test
     */
    public function setUp()
    {
        parent::setUp();
        $this->prepareForTests();
    }
 
    /**
     * Migrates the database and seeds test data if requested by the test.
     */
    private function prepareForTests()
    {
        if($this->useDatabase){
            Artisan::call('migrate');
            Eloquent::unguard();
            Artisan::call('db:seed',['--class' => 'TestDataSeeder']);
        }
    }
}
