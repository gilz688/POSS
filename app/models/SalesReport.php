<?php
use Carbon\Carbon;
class SalesReport{
	private $start;
	private $end;
	private $rows;
	private $header = ['hour','transactions','items','sales'];
	private $repository;

	public function __construct(TransactionRepository $repository, Carbon $start, Carbon $end){
			$this->start = $start;
			$this->end = $end;
			$this->repository = $repository;
			$this->generate();
	}

	private function generate(){
		$a = clone $this->start;
		$this->rows = [];
		for($i=6;$i<18;$i++){
			$a->setTime($i,0,0);
			$next = clone $a;
			$next->addHour();
			$transactions = $this->repository->get($a,$next);
			$total = $this->getTotal($transactions);
			$row = [
				'hour' => $a->format('g:ia') . '-' . $next->format('g:ia'),
				'transactions' => count($transactions),
				'items' => $total['items'],
				'sales' => $total['sales']
			];
			array_push($this->rows,$row);
			$a=$next;
		}
	}

	private function getTotal($transactions){
		$sales = 0.0;
		$items = 0;
		foreach($transactions as $transaction){
			$total = $this->repository->getTotal($transaction['id']);
			$items += $total['items'];
			$sales += $total['sales'];
		}
		return ['items' => $items, 'sales' => $sales];
	}

	public function getRows(){
		return $this->rows;
	}

	public function getHeader(){
		return $this->header;
	}
}