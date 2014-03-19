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

        foreach ($items as $item) {
            PurchasedItem::create($item);
        }
    }

}
