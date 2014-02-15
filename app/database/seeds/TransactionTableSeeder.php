<?php

class TransactionTableSeeder extends DatabaseSeeder{
    	public function run()
		{
				$transactions = [
				[
					'item_id' => 'shampoo',
					'status' => ('unvoid'),
					
				]
			];
				
				foreach ($transactions as $transactions)
				{
					Transaction::create($transaction);
				}   
		}
}
