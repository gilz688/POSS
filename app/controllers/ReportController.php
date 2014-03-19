<?php
use Carbon\Carbon;
class ReportController extends Controller{
	
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository) {
        $this->transactionRepository = $transactionRepository;
    }

	public function getSalesReport(){
		$start = Carbon::create(2014,03,13,0,0,0);
		$end = $start->addDay();
		$report = new SalesReport($this->transactionRepository,$start,$end);
		$rows = $report->getRows();
		return View::make('report.sales', ['rows' => $rows]);
	}
	
	// Display all clerk
	public function displayAllClerk() {
		$users = new UserRepository;
		return View::make('report.display', array(
				'users'=> $users->displayClerk()
			));
	}

	// Display clerk performance
	public function show($creator_id){
		$clerk = new ClerkPerformance;
		$t = $clerk->getTran($creator_id);		// Returns an array.
		return View::make('report.clerk',['rows' => $t]);
	}
}