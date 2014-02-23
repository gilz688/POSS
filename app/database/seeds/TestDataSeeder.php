<?php

class TestDataSeeder extends DatabaseSeeder {

    public function run() {
        Eloquent::unguard();
        $this->call('TestUserTableSeeder');
        $this->call('ItemCategoriesTableSeeder');   
        $this->call('TestItemsTableSeeder');  
        $this->call('TestTransactionTableSeeder');
        $this->call('TestPurchasedItemsTableSeeder');
    }

}
