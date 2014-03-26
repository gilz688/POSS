<?php

class ProductReport {
	public function getProduct() {
		
		$purchased = new PurchasedItemRepository;
		$p1 = $purchased->all()->toArray();
		$sizeP1 = count($p1);
		$item = new ItemRepository;

		$totalQuantity = [];
		for ($i=0; $i < $sizeP1; $i++) { 
			$a = $p1[$i];
			$searchName = $item->find($a['barcode']);
			$name = $searchName['itemName'];
			if(isset($totalQuantity[$name])) {
				$totalQuantity[$name] += $a['quantity'];
			} else {
				$totalQuantity[$name] = $a['quantity'];
			}
		}

		$totalPrice = [];
		$sizeQuantity = count($totalQuantity);
		for ($j=0; $j < $sizeQuantity; $j++) { 
			$a2 = $p1[$j];
			$searchName2 = $item->find($a2['barcode']);
			$name2 = $searchName2['itemName'];
			$price = $searchName2['price'];
			if(isset($totalPrice[$name2])) {
				$totalPrice[$name2] += $a2['quantity'] * $price;
			} else {
				$totalPrice[$name2] = $a2['quantity'] * $price;
			}
		}

		arsort($totalQuantity);
		arsort($totalPrice);

		return [array_slice($totalQuantity, 0, 5), array_slice($totalPrice, 0, 5)];
		

	}

	public function getInt($value) {
		return (int) $value;
	}

}
