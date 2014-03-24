<?php

class TestItemsCsvSeeder extends BaseSeeder {

    public function __construct() {
        $this->table = 'items';
        $this->filename = app_path() . '/database/csv/items.csv';
    }
    
}
