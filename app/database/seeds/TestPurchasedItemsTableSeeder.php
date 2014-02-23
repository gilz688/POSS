<?php

class TestPurchasedItemsTableSeeder extends DatabaseSeeder {

    public function run() {
       $items = [
            [
                'barcode' => 5011321361058,
                'quantity' => 1,
                'transaction_id' => 1
            ],
            [
                'barcode' => 52000324822,
                'quantity' => 1,
                'transaction_id' => 1
            ],
            [
                'barcode' => 4800119220803,
                'quantity' => 1,
                'transaction_id' => 1
            ]
        ];

        foreach ($items as $item) {
            PurchasedItem::create($item);
        }
    }

}
