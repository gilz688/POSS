<?php

class InventoryItemRepository implements TableRepository{

    protected static $writePermissions = [
        'admin' => true,
        'auditor' => false,
        'clerk' => false,
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
            'quantity' => 'required|Integer',
            'price' => 'required'
        ];
        $validator = Validator::make($attributes, $rules);
        $find = InventoryItem::find($attributes['barcode']);
        $find1 = Item::find($attributes['barcode']);
        if(($validator->passes()) and ($find == null) and ($find1 != null)) {
            $inventory = new InventoryItem;
            $inventory->barcode = $attributes['barcode'];
            $inventory->quantity = $attributes['quantity'];
            $inventory->price = $attributes['price'];
            $inventory->save();
            return $inventory->barcode;
        } else {
            throw new ErrorException("Cannot add to the inventory.");
        }
    }

    public function delete($barcode) {
        $this->checkWritePermissions();
        $inventory = InventoryItem::find($barcode);
        if($inventory != null) {
            $inventory->delete();
        } else {
            throw new ErrorException("Invalid barcode!");
        }
    }   

    public function all() {
        $this->checkReadPermissions();
        return InventoryItem::orderBy('barcode')->get();
    }

    public function edit($barcode, $attributes) {
        $this->checkWritePermissions();
        $inventoryItem = InventoryItem::find($barcode);
        if ($inventoryItem == null) {
            throw new ErrorException("Invalid barcode!");
        } else {
            if (array_key_exists('quantity', $attributes)) {
                $quantity = $attributes['quantity'];
                if(gettype($quantity) == 'integer') {
                    $inventoryItem->quantity = $attributes['quantity'];
                } else {
                    throw new ErrorException("Quantity should be integer!");
                }
            }
            if (array_key_exists('price', $attributes)) {
                $price = $attributes['price'];
                if(gettype($price) == 'integer') {
                    $inventoryItem->price = $attributes['price'];
                } else {
                    throw new ErrorException("Price should be integer!");
                }
            }
            $inventoryItem->update();
        }
    }
    
    public function find($barcode) {
        $this->checkReadPermissions();
        $inventory = InventoryItem::find($barcode);
        if ($inventory == null) {
            return null;
        } else {
            return $inventory->attributesToArray();
        }
    }
}
