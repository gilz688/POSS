<?php

class TestInventoryItemTableSeeder extends DatabaseSeeder {

    public function run() {
        $inventoryItems = [
            [
                'barcode' => 5011321361058,
                'quantity' => 100,
                'price' => 4.10
            ]
        ];

        Eloquent::unguard();
        foreach ($inventoryItems as $inventoryItem) {
            InventoryItem::create($inventoryItem);
        }
    
	}

}
