<?php

use Carbon\Carbon;

class SalesReport {

    private $start;
    private $end;
    private $data;
    private $repository;
    private $header = ['hour', 'transactions', 'items', 'sales'];

    public function __construct(TransactionRepository $repository, $start, $end) {
        $this->start = $start;
        $this->end = $end;
        $this->repository = $repository;
    }

    public function generate() {
        if (Auth::user() == null) {
            throw new UnauthorizedException("User is not logged in!");
        }

        $role = Auth::user()->role;
        if ($role != 'admin' && $role != 'auditor') {
            throw new UnauthorizedException("User is not authorized to access all transactions!");
        }

        $this->repository = new TransactionRepository;
        $a = Carbon::createFromFormat('m/d/Y', $this->start);
        $a->setTime(8, 0, 0);
        $b = Carbon::createFromFormat('m/d/Y', $this->end);
        $b->setTime(17, 59, 59);

        $this->data = [];
        $this->log = "";
        while ($a->day < $b->day + 1) {
            for ($i = 8; $i < 18; $i++) {
                $a->hour = $i;
                $a->minute = 0;
                $next = $a->copy();
                $next->addHour()->subSecond();
                $transactions = $this->repository->get($a, $next);
                $total = $this->getTotal($transactions);
                $total['transactions'] = count($transactions);

                if (array_key_exists($i, $this->data)) {
                    $total['items'] += $this->data[$i]['items'];
                    $total['sales'] += $this->data[$i]['sales'];
                    $total['transactions'] += $this->data[$i]['transactions'];
                }

                $this->data[$i] = $total;
            }
            $a->addDay();
        }
    }

    public function getData() {
        return $this->data;
    }

    private function getTotal($transactions) {
        $sales = 0.0;
        $items = 0;
        foreach ($transactions as $transaction) {
            $total = $this->repository->getTotal($transaction['id']);
            $items += $total['items'];
            $sales += $total['sales'];
        }
        return ['items' => $items, 'sales' => $sales];
    }

    public function getRows() {
        $rows = [];
        for ($i = 8; $i < 18; $i++) {
            if ($i > 12) {
                $j = strval($i - 12);
                $hour = $j . ':00pm-' . $j . ':59pm';
            } else {
                $j = strval($i);
                $hour = $i . ':00am-' . $i . ':59am';
            }
            array_push($rows, [
                'hour' => $hour,
                'sales' => $this->data[$i]['sales'],
                'items' => $this->data[$i]['items'],
                'transactions' => $this->data[$i]['transactions']
            ]);
        }
        return $rows;
    }

    public function getHeader() {
        return $this->header;
    }
}
