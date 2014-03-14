<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();
        $this->call('TestUserTableSeeder');
        $this->call('ItemCategoriesTableSeeder');
        $this->call('TestItemsTableSeeder');
        $this->call('TestInventoryItemTableSeeder');
        $this->call('TestTransactionTableSeeder');
        $this->call('TestPurchasedItemsTableSeeder');
    }

}
