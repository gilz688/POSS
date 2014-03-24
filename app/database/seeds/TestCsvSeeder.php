<?php

class TestCsvSeeder extends DatabaseSeeder {

    public function run() {
        Eloquent::unguard();
        $this->call('TestUserCsvSeeder');
        $this->call('ItemCategoriesCsvSeeder');   
        $this->call('TestItemsCsvSeeder');  
        $this->call('TestTransactionCsvSeeder');
        $this->call('TestPurchasedItemsCsvSeeder');
    }

}
