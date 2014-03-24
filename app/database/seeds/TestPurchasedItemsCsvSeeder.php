<?php

class TestPurchasedItemsCsvSeeder extends BaseSeeder {

    public function __construct() {
        $this->table = 'purchased_items';
        $this->filename = app_path() . '/database/csv/purchaseditems.csv';
    }
    
}
