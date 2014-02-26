<?php

class InventoryItemRepository implements TableRepository{

    protected static $writePermissions = [
        'admin' => false,
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
            throw new UnauthorizedException('Access to table repository is denied!');
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
        $rules =[
			'barcode' => 'required|Unique:inventory_items',
			'quantity' => 'required',
			'price' => 'required'
		];
		$validator = Validator::make($attributes, $rules);
		if($validator->passes()) {
			$look = $attributes['barcode'];
			$find = Item::find($look);
			if($find != null) {
				$inventory = new InventoryItem;
				$inventory->barcode = $attributes['barcode'];
				$inventory->quantity = $attributes['quantity'];
				$inventory->price = $attributes['price'];
				$inventory->save();
				return $inventory->barcode;
			} else {
				throw new ErrorException("Cannot add inventory");
			}
		} else {
			throw new ErrorException("Invalid data!");
		}
    }

    public function delete($id) {
        $this->checkWritePermissions();
    }	

    public function all() {
        $this->checkReadPermissions();
        return InventoryItem::all();
    }

    public function edit($id, $attributes) {
        $this->checkWritePermissions();
        // some code here
    }
    
    public function find($barcode) {
        $this->checkReadPermissions();
        $inventory = Item::find($barcode);
		if ($inventory == null) {
			return null;
		} else {
			return $inventory->attributesToArray();
		}
    }
}
