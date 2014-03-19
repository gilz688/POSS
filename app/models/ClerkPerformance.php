<?php


class ClerkPerformance {

	// This function returns an array
	public function getTran($creator_id) {
		

		$user = DB::table('transactions')->where('creator_id', '=', $creator_id)->get();
		$user = array_fetch($user,'id');	// Transaction id created by the clerk
		
		$date = DB::table('transactions')->where('creator_id', '=', $creator_id)->get();
		$date = array_fetch($date, 'created_at');	// Date of the created transaction
		
		// Count the number of elements
		$count = DB::table('transactions')->where('creator_id', '=', $creator_id)->count();
		
		$transaction = new TransactionRepository;
		
		$array = [];
		
		for($i=0;$i<$count;$i++) {

			$a = $this->getTransactionId($user[$i]);	// String to Int

			// Get the total transaction
			$total = $transaction->getTotal($a);
			
			$row = [
				'date' => $date[$i],
				'sales' => $total['sales']
			];

			array_push($array,$row);	// Insert to $row to $array.
		}
		
		return $array;
	}

	// Getter/Accessor
	public function getTransactionId($value) {
		return (int) $value;
	}
}