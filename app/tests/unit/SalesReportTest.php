<?php

use Carbon\Carbon;

class SalesReportTest extends TestCase {
	protected $useDatabase = true;

    /*	
     *	Test constructor with valid parameters
     */	
  	public function testConstructor(){
  		Auth::attempt($this->auditorCredentials);
		$start = Carbon::createFromDate(2014,3,1);
		$end = Carbon::createFromDate(2014,3,20);
		$transactionRepo = new TransactionRepository;
		$report = new SalesReport($transactionRepo,$start, $end);
		$this->assertNotNull($report);
    }

    /*	
     *	Test getRows()
     */	
	public function testGetRows(){
		$start = Carbon::createFromDate(2014,3,1);
		$end = Carbon::createFromDate(2014,3,20);
		Auth::attempt($this->auditorCredentials);
		$transactionRepo = new TransactionRepository;
		$report = new SalesReport($transactionRepo,$start, $end);
		$rows = $report->getRows();
    }
}