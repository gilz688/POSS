<?php
use Carbon\Carbon;

class TestTransactionTableSeeder extends DatabaseSeeder {

    public function run() {

        $transactions = [
            [
                'cashier_number' => 1,
                'creator_id' => 2,
                'payment' => 100,
                'total' => 40,
                'change' => 60
            ],
            [
                 'cashier_number' => 1,
                'creator_id' => 2,
                'payment' => 250,
                'total' => 30,
                'change' => 220
            ],
            [
                 'cashier_number' => 4,
                'creator_id' => 1,
                'payment' => 400,
                'total' => 40,
                'change' => 360
            ]
        ];

        
       

        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }
    }

}
