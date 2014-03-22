<?php

class TestItemsTableSeeder extends DatabaseSeeder {

    public function run() {

        $items = [
            [
                'barcode' => 5011321361058,
                'itemName' => 'Shampoo',
                'price' => 30.25,
                'quantity' => 50,
                'itemDescription' => 'Head & Shoulders Anti-dandruff Shampoo - refreshing',
                'label' => '6pcs/half dozen',
                'category_id' => 10
            ],
            [
                'barcode' => 5200032482284,
                'itemName' => 'Sports Drink',
                'price' => 30.25,
                'quantity' => 50,
                'itemDescription' => 'Gatorade Sports Drink, Fierce Grape',
                'label' => '20oz',
                'category_id' => 3
            ],
            [
                'barcode' => 4800119220803,
                'itemName' => 'Ethyl Alcohol',
                'price' => 17.50,
                'quantity' => 50,
                'itemDescription' => 'Hygienix 60% Ethyl Alcohol',
                'label' => '60mL',
                'category_id' => 10
            ],
            [
                'barcode' => 4806517213096,
                'itemName' => 'Aficionado Body Spray',
                'price' => 100.25,
                'quantity' => 50,
                'itemDescription' => 'Aficionado Bath & Body Spray Fancy Fragrance',
                'label' => '55mL',
                'category_id' => 10
            ],
            [
                'barcode' => 4842850036564,
                'itemName' => 'UFC Tamis Anghang Catsup',
                'price' => 11.25,
                'quantity' => 50,
                'itemDescription' => 'The new UFC Tamis Anghang Banana Catsup loved by the whole family!',
                'label' => '200g',
                'category_id' => 7
            ],
            [
                'barcode' => 4807770120213,
                'itemName' => 'Nissin Wafer',
                'price' => 32.75,
                'quantity' => 50,
                'itemDescription' => 'Monde Nissin Wafer-mas pinalaki na!',
                'label' => '12g x 20pcs',
                'category_id' => 6
            ],
            [
                'barcode' => 4807770270291,
                'itemName' => 'Gardenia Loaf Bread',
                'price' => 73.75,
                'quantity' => 50,
                'itemDescription' => 'Gradenia loaf bred-masarap kahit walang palaman.',
                'label' => '100g',
                'category_id' => 4
            ],
            [
                'barcode' => 4800088145053,
                'itemName' => 'Australian Karne Norte',
                'price' => 13.35,
                'quantity' => 50,
                'itemDescription' => 'Australian Karne Nortemade from finest ingredients.',
                'label' => '100g',
                'category_id' => 5
            ],
            [
                'barcode' => 4809189220213,
                'itemName' => 'Selecta Ice Cream',
                'price' => 159.50,
                'quantity' => 50,
                'itemDescription' => 'Selecta Ice Cream 3 in 1 + 1!',
                'label' => '1L',
                'category_id' => 9
            ],
            [
                'barcode' => 4807770166534,
                'itemName' => 'Silka Papaya Soap',
                'price' => 16.25,
                'quantity' => 50,
                'itemDescription' => 'Silka Papaya Soap whitens skin in just 7 days.!',
                'label' => '65g',
                'category_id' => 10
            ]
        ];

        Eloquent::unguard();
        foreach ($items as $item) {
            Item::create($item);
        }
    }

}
