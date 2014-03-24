<?php
use Carbon\Carbon;
class ReportController extends Controller{
	
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository) {
        $this->transactionRepository = $transactionRepository;
    }

	public function getSalesReport(){
		return View::make('report.sales');
	}

	public function postSalesReport(){
		$start = Carbon::createFromFormat('m/d/Y', Input::get('start'));
		$end = Carbon::createFromFormat('m/d/Y', Input::get('end'));
		$report = new SalesReport($this->transactionRepository,$start,$end);
		return Response::json([
			'header' => $report->getHeader(),
			'rows' => $report->getRows()
		]);
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

	public function productsReport() {
		$products = new ProductReport;
		$a = $products->getProduct();
		return View::make('report.product', ['quantities' => $a[0], 'prices' => $a[1]]);
	}
}