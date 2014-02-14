<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Seeds database with initial data.
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
                $this->call('UserTableSeeder');
	}

}