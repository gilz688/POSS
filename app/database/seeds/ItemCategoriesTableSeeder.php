<?php

class ItemCategoriesTableSeeder extends DatabaseSeeder {

    public function run() {

        $itemCategories = [
            [
                'name' => 'Baby Items',
                'description' => 'diapers, baby food, etc.'
            ],
            [
                'name' => 'Baking',
                'description' => 'flour, sugar, cake mixes, icings, cooking oil, etc',
            ],
            [
                'name' => 'Beverages',
                'description' => 'tea, coffee, soda, juice, mineral water, etc',
            ],
            [
                'name' => 'Bread/Bakery',
                'description' => 'rolls, bread, cakes, pies, muffins, donuts, cookies, etc',
            ],
            [
                'name' => 'Canned Goods',
                'description' => 'canned sardines, meat, beans, etc',
            ],
            [
                'name' => 'Cereal/Breakfast',
                'description' => 'cereals, oatmeal, breakfast bars, etc',
            ],
            [
                'name' => 'Condiments',
                'description' => 'ketchup, soysauce, pickle relish, salad dressing, croutons, jelly, etc',
            ],
            [
                'name' => 'Dairy',
                'description' => 'milk, eggs, cheeses, etc.',
            ],
            [
                'name' => 'Frozen Foods',
                'description' => 'anything frozen, including ice cream, vegetables, fruits, etc',
            ],
            [
                'name' => 'Health & Beauty',
                'description' => 'pharmacy items, shampoo, toothpaste',
            ]
        ];

        foreach ($itemCategories as $category) {
            ItemCategory::create($category);
        }
    }

}
