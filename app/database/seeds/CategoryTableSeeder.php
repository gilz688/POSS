<?php

class CategoryTableSeeder extends DatabaseSeeder{
    	public function run()
	{
            $categories = [
            [
                'categoryName' => 'cosmetics'
                
            ]
        ];
            
            foreach ($categories as $categories)
            {
                Category::create($category);
            }   
	}
}
