<?php

class TestPurchasedItemsTableSeeder extends DatabaseSeeder {

    public function run() {

        $items = [
            [
                'barcode' => 5011321361058,
                'quantity' => 1,
                'id' => 1
            ],
            [
                'barcode' => 5200032482284,
                'quantity' => 1,
                'id' => 1
            ],
            [
                'barcode' => 4800119220803,
                'quantity' => 1,
                'id' => 1
            ],
            [
                'barcode' => 4800119220803,
                'quantity' => 1,
                'id' => 2
            ],
            [
                'barcode' => 5011321361058,
                'quantity' => 12,
                'id' => 2
            ],
            [
                'barcode' => 5200032482284,
                'quantity' => 5,
                'id' => 3
            ],
            [
                'barcode' => 4806517213096,
                'quantity' => 1,
                'id' => 3
            ],
            [
                'barcode' => 4807770120213,
                'quantity' => 2,
                'id' => 3
            ],
            [
                'barcode' => 4807770270291,
                'quantity' => 2,
                'id' => 3
            ],
            [
                'barcode' => 4809189220213,
                'quantity' => 1,
                'id' => 3
            ]
        ];
        $transactions = Transaction::all(['id'])->toArray();
        $inventoryItems = Item::all(['barcode'])->toArray();
        $faker = Faker\Factory::create();

        foreach ($transactions as $transaction) {
            if ($transaction['id'] > 3) {
                for ($i = 0; $i < $faker->numberBetween(1, 12); $i++) {
                    try{
                    $bc = $faker->unique($i == 0)->randomElement($inventoryItems)['barcode'];
                    $trans = $transaction['id'];
                    array_push($items, [
                        'barcode' => $bc,
                        'quantity' => $faker->randomNumber(1, 12),
                        'id' => $trans
                    ]);
                    }catch(OverflowException $e){
                        
                    }
                }
            }
        }

        foreach ($items as $item) {
            PurchasedItem::create($item);
        }
    }

}
