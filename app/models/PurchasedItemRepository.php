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
            'id' => 'required'];
        
        $validator = Validator::make($attributes, $rules);
        if ($validator->passes()) {
			$inventory_item = Item::find($attributes['barcode']);
			$old_quantity = $inventory_item->quantity;
			if($old_quantity - $attributes['quantity'] < 0){
				throw new ErrorException('Not enough items');
			}
			else{
			
				$purchasedItem = new PurchasedItem;
				$purchasedItem->barcode = $attributes['barcode'];
				$purchasedItem->quantity = $attributes['quantity'];
				$purchasedItem->id = $attributes['id'];    
				$purchasedItem->save();   
				$new_quantity = $old_quantity - $attributes['quantity'];
				$inventory_item->quantity = $new_quantity;
				$inventory_item->update();
				return $purchasedItem['barcode'];
			}
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

    public function all(array $columns = ["*"]) {
		$this->checkReadPermissions();
        return PurchasedItem::orderBy('id')->get();
    }

    public function edit($barcode, $attributes) {
		$this->checkWritePermissions();
		$item = PurchasedItem::find($barcode);
		if($barcode == null){
			throw new IllegalOperationException('Invalid Barcode');}
		else {
			if(array_key_exists('quantity',$attributes)){
				$quantity = $attributes['quantity'];
					$item->quantity = $quantity;
					$item->update();
			}
			
		}
    }

    public function find($barcode) {
        $item = PurchasedItem::find($barcode);
        if ($item == null) {
            return null;
        } else {
            return $item->attributesToArray();
        }
    }

    public function paginate($limit = 10){
        $items = PurchasedItem::paginate($limit);
        return $items;
    }
}
