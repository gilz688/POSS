<?php
use Carbon\Carbon;

class TestTransactionTableSeeder extends DatabaseSeeder {

    public function run() {

        $transactions = [
            [
                'cashier_number' => 1,
                'creator_id' => 2
            ],
            [
                'cashier_number' => 3,
                'creator_id' => 2
            ],
            [
                'cashier_number' => 2,
                'creator_id' => 3
            ]
        ];
        $clerks = User::where('role','clerk')->get(['id'])->toArray();
        $faker = Faker\Factory::create();
        
        for($i=0;$i<100;$i++){
            $dateCreated = Carbon::instance($faker->dateTimeBetween('-1 month', '-1 day'));
            $dateCreated->setTime($faker->numberBetween(8,17), $faker->numberBetween(0,59));
            array_push($transactions, [
                'cashier_number' => rand(1,5),
                'creator_id' => $faker->randomElement($clerks)['id'],
                'created_at' => $dateCreated,
                'updated_at' => $dateCreated
            ]);
        }

        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }
    }

}
