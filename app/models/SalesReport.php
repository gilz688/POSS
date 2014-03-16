<?php
use Carbon\Carbon;
class SalesReport{
	private $start;
	private $end;
	private $rows;
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
				'sales' => $total['sales'],
				'number' => $total['number']
			];
			array_push($this->rows,$row);
			$a=$next;
		}
	}

	private function getTotal($transactions){
		$sales = 0.0;
		$number = 0;
		foreach($transactions as $transaction){
			$total = $this->repository->getTotal($transaction['id']);
			$sales += $total['sales'];
			$number += $total['items'];
		}
		return ['sales' => $sales, 'number' => $number];
	}

	public function getRows(){
		return $this->rows;
	}
}