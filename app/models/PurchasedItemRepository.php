<?php

class PurchasedItemRepository implements TableRepository {

	 protected static $writePermissions = [
        'admin' => true,
        'auditor' => false,
        'clerk' => true,
        null => false
    ];
    
    protected static $readPermissions = [
        'admin' => true,
        'auditor' => true,
        'clerk' => true,
        null => false
    ];

    public function checkWritePermissions() {
        $role = Auth::user()->role;
        if (self::$writePermissions[$role] != true) {
            throw new UnauthorizedException('Write access to table repository is denied!');
        }
    }
    
    public function checkReadPermissions() {
        $role = Auth::user()->role;
        if (self::$readPermissions[$role] != true) {
            throw new UnauthorizedException('Read access to table repository is denied!');
        }
    }

    public function add($attributes) {
        $this->checkWritePermissions();
        $rules = [
            'barcode' => 'required',
            'quantity' => 'required',
            'transaction_id' => 'required'];
        
        $validator = Validator::make($attributes, $rules);
        if ($validator->passes()) {
            $purchasedItem = new PurchasedItem;
            $purchasedItem->barcode = $attributes['barcode'];
            $purchasedItem->quantity = $attributes['quantity'];
            $purchasedItem->transaction_id = $attributes['transaction_id'];
            $purchasedItem->save();
            return $purchasedItem;
        } else {
            throw new ErrorException("Invalid data!");
        }
    }

    public function delete($barcode) {
		$this->checkWritePermissions();
		$item = PurchasedItem::find($barcode);
		if($item != null){
			$item->delete();
		}
		else{
			throw new ErrorException("Invalid Barcode");
		}
       
    }

    public function all() {
		$this->checkReadPermissions();
        return PurchasedItem::orderBy('transaction_id')->get();
    }

    public function edit($id, $attributes) {
		$this->checkWritePermissions();
		$item = PurchasedItem::find($id);
		if($id == null){
			throw new IllegalOperationException('Invalid Barcode');}
		else {
			if(array_key_exists('quantity',$attributes)){
				$quantity = $attributes['quantity'];
					$item->quantity = $attributes['quantity'];
					$item->update();
			}
			
		}
    }

    public function find($id) {
        $item = PurchasedItem::find($id);
        if ($item == null) {
            return null;
        } else {
            return $item->attributesToArray();
        }
    }

}
