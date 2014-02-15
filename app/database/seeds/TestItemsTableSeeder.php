<?php

class TestItemsTableSeeder extends DatabaseSeeder {

    public function run() {
        $items = [
            [
                'barcode' => 5011321361058,
                'name' => 'Shampoo',
                'description' => 'Head & Shoulders Anti-dandruff Shampoo - refreshing',
                'size_or_weight' => '400mL',
                'category_id' => 10
                
            ],
            [
                'barcode' => 052000324822,
                'name' => 'Sports Drink',
                'description' => 'Gatorade Sports Drink, Fierce Grape',
                'size_or_weight' => '20oz',
                'category_id' => 3
            ],
            [
                'barcode' => 4800119220803,
                'name' => 'Ethyl Alcohol',
                'description' => 'Hygienix 60% Ethyl Alcohol',
                'size_or_weight' => '60mL',
                'category_id' => 10
            ]
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }

}
