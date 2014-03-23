<?php

class TestItemCategoriesCsvSeeder extends BaseSeeder {

    public function __construct() {
        $this->table = 'item_categories';
        $this->filename = app_path() . '/database/csv/itemcategories.csv';
    }
    
}
