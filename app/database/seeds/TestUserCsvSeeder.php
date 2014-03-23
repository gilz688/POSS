<?php

class TestUserCsvSeeder extends BaseSeeder {

    public function __construct() {
        $this->table = 'users'; // Your database table name
        $this->filename = app_path() . '/database/csv/users.csv'; // Filename and location of data in csv file
    }

}
