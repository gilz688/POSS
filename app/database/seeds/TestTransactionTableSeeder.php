<?php

class TestTransactionTableSeeder extends DatabaseSeeder {

    public function run() {
        $transactions = [
            [
                'cashier_number' => 1,
                'creator_id' => 2
            ],
            [
                'cashier_number' => 2,
                'creator_id' => 3
            ]
        ];

        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }
    }

}
