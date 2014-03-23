<?php

use Carbon\Carbon;

class SalesReportTest extends TestCase {
	protected $useDatabase = true;

    /*  
     *  Test private function getTotal()
     */ 
    public function testGetTotal(){
        Auth::attempt($this->auditorCredentials);

        $reflection_class = new ReflectionClass("SalesReport");
        $method = $reflection_class->getMethod("getTotal");
        $method->setAccessible(true);

        $transactions = [
            ['id' => '1'],
            ['id' => '2'],
            ['id' => '3']
        ];

        $report = new SalesReport(new TransactionRepository, '03/23/2014', '03/23/2014');
        $total = $method->invoke($report, $transactions);
        $this->assertEquals($total,['items' => 10, 'sales' => 1082.5]);
    }

    /*  
     *  Test private function getTotal() with zero transactions
     */ 
    public function testGetTotalWithZeroTransaction(){
        Auth::attempt($this->auditorCredentials);

        $reflection_class = new ReflectionClass("SalesReport");
        $method = $reflection_class->getMethod("getTotal");
        $method->setAccessible(true);

        $transactions = [];

        $report = new SalesReport(new TransactionRepository, '03/23/2014', '03/23/2014');
        $total = $method->invoke($report, $transactions);
        $this->assertEquals($total,['items' => 0, 'sales' => 0]);
    }

    /*  
     *  Test getRows() with user logged in as auditor
     */ 
    public function testGetDataAsAuditor(){
        Auth::attempt($this->auditorCredentials);
        $report = new SalesReport(new TransactionRepository, '03/23/2014', '03/23/2014');
        $report->generate();
        $data = $report->getData();
        $expectedData = [
            8 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            9 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            10 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            11 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            12 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            13 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            14 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            15 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            16 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            17 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0]
        ];
        $this->assertEquals($data,$expectedData);
    }

    /*  
     *  Test getRows() with user logged in as admin
     */ 
    public function testGetDataAsAdmin(){
        Auth::attempt($this->auditorCredentials);
        $report = new SalesReport(new TransactionRepository, '03/23/2014', '03/23/2014');
        $report->generate();
        $data = $report->getData();
        $expectedData = [
            8 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            9 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            10 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            11 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            12 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            13 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            14 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            15 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            16 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            17 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0]
        ];
        $this->assertEquals($data,$expectedData);
    }

    /*  
     *  Test getRows() with user logged in as clerk
     *  @expectedException UnauthorizedException
     */ 
    public function testGetDataAsClerk(){
        Auth::attempt($this->auditorCredentials);
        $report = new SalesReport(new TransactionRepository, '03/23/2014', '03/23/2014');
        $report->generate();
        $data = $report->getData();
        $expectedData = [
            8 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            9 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            10 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            11 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            12 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            13 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            14 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            15 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            16 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0],
            17 => ['transactions' => 0, 'items' => 0, 'sales' => 0.0]
        ];
        $this->assertEquals($data,$expectedData);
    }
}