<?php

class TestTransactionsCsvSeeder extends BaseSeeder {

    public function __construct() {
        $this->table = 'transactions';
        $this->filename = app_path() . '/database/csv/transactions.csv';
    }
    
}
