<?php


class ClerkPerformance {


	//private $rows;
	//private $header = ['date','sales'];

	// This function returns an array
	public function getTran($creator_id) {
		if (Auth::user()->role == 'admin') {
		
			$date = DB::table('transactions')->where('creator_id', '=', $creator_id)->get();
			$date = array_fetch($date,'created_at');	// Date of created Transaction 		
			
			if($date != null) {
				$transaction = new TransactionRepository;
				
				$array = [];

				$result = array_unique($date); // Unique element of the array $date

				foreach($result as $results) {
					
					$search = DB::table('transactions')->where('created_at','=', $results)
								->where('creator_id', '=', $creator_id)->get();
					$search = array_fetch($search,'id');	
					$count = count($search);	
					
					$sum = 0.0;

					for($i=0;$i<$count;$i++){
						$a = $this->getTransactionId($search[$i]);	// String to Int

						// Get the total transaction
						$total = $transaction->getTotal($a);
						$sum += $total['sales'];
					}

					$row = [
						'date' => $this->getDate($results),
						'sales' => $sum
					];

					array_push($array, $row);
				}

				return $array;
			
			} else {
				throw new ErrorException("Invalid id.");
			}		

		} else {
			throw new UnauthorizedException('Access denied.');
		}
	}

	// Returns the int
	public function getTransactionId($value) {
		return (int) $value;
	}

	// Returns the date format of month-date-year
	public function getDate($value){
		$a = strtotime($value);
		$b = date('m-d-Y', $a);
		return $b;
	}

	/*
	public function getRows(){
		return $this->rows;
	}

	public function getHeader(){
		return $this->header;
	}
	*/

}