<?php

class SalesReportTest extends TestCase {
	protected $useDatabase = true;

    /*	
     *	Test constructor with valid parameters
     */	
  	public function testConstructor(){
  		Auth::attempt($this->auditorCredentials);
		$start = new DateTime('2014-03-14');
		$end = new DateTime('2014-03-15');
		$report = new SalesReport($start, $end);
		$this->assertNotNull($report);
    }

    /*	
     *	Test constructor with invalid parameters
     *	@expectedException ErrorException 
     */	
  	public function testConstructorwithInvalidParam(){
		$start = '2014-03-14';
		$end = '2014-03-15';
		Auth::attempt($this->auditorCredentials);
		$report = new SalesReport($start, $end);
    }

    /*	
     *	Test getRows()
     */	
	public function testGetRows(){
		Auth::attempt($this->auditorCredentials);
		$start = new DateTime('2014-03-14');
		$end = new DateTime('2014-03-15');
		$start->setTime(8,0);
		$end->setTime(17,0);
		$report = new SalesReport($start, $end);
		$rows = $report->getRows();
    }
}