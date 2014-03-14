<?php
class ReportController extends Controller{
	
	public function getSalesReport(){
		$rows = [
			['date' => '3/14/2014', 'hour' => '3:00-4:00', 'sales' => '800'],
			['date' => '3/14/2014', 'hour' => '4:00-5:00', 'sales' => '1000']
		];
		return View::make('report.sales', array('rows' => $rows));
	}
}