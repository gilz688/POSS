<?php

class ItemTableSeeder extends DatabaseSeeder{
public function run()
	{
            $items = [
            [
                'categoryName' => 'cosmetics'
                
            ]
        ];
            
            foreach ($items as $items)
            {
                Item::create($item);
            }   
	}
}