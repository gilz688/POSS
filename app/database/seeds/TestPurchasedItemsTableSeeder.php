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
            ]
        ];

        foreach ($items as $item) {
            PurchasedItem::create($item);
        }
    }

}
