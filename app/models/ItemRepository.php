<?php

class ItemRepository implements TableRepository{

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

	public function all(array $columns = ["*"]) {
        $this->checkReadPermissions();
        return Item::orderBy('barcode')->get($columns);
    }
	
    public function add($attributes) {
        $this->checkWritePermissions();
        $rules = [ 
			'barcode' => 'required',
			'itemName' => 'required|Unique:items',
			'price' => 'required',
			'quantity' => 'required',
            'itemDescription' => 'required',
			'label' => 'required',
			'category_id' => 'required'];
        $validator = Validator::make($attributes, $rules);
        if ($validator->passes()) {
            $item = new Item;
			$item->barcode = $attributes['barcode'];
            $item->itemName = $attributes['itemName'];
			$item->price = $attributes['price'];
			$item->quantity = $attributes['quantity'];
            $item->itemDescription = $attributes['itemDescription'];
			$item->label = $attributes['label'];
			$item->category_id = $attributes['category_id'];
            $item->save();
            return $item->barcode;
        } else {
            throw new ErrorException("Invalid data!");
        }
    }

    public function delete($barcode) {
        $this->checkWritePermissions();
        $item = Item::find($barcode);
        if ($item != null) {
            $item->delete();
        } else {
            throw new ErrorException("Invalid barcode!");
        }
    }
	
    public function edit($barcode, $attributes) {
        $this->checkWritePermissions();
        $item = Item::find($barcode);

        if ($barcode == null && $barcode < 10000000000000) {
            throw new ErrorException("Invalid barcode!");
        } 
		else {
            if(array_key_exists('itemName',$attributes)){
                $itemName = $attributes['itemName'];
                if(gettype($itemName) == 'string'){
                    $item->itemName = $attributes['itemName'];
                }
                else{
                    throw new ErrorException('Name should be a string!');
                }
            }
			if(array_key_exists('price',$attributes)){
                $price = doubleval($attributes['price']);
                $item->price = $attributes['price'];
            }
			if(array_key_exists('quantity',$attributes)){
                $quantity = intval($attributes['quantity']);
				$item->quantity = $attributes['quantity'];
            }
            if(array_key_exists('itemDescription',$attributes)){
                $itemDescription = $attributes['itemDescription'];
                if(gettype($itemDescription) == 'string'){
                    $item->itemDescription = $attributes['itemDescription'];
                }
                else{
                    throw new ErrorException('Description should be string!');
                }
            }
			if(array_key_exists('label',$attributes)){
                $label = $attributes['label'];
                if(gettype($label) == 'string'){
                    $item->label = $attributes['label'];
                }
                else{
                    throw new ErrorException('Label should be string!');
                }
                
            }
			if(array_key_exists('category_id',$attributes)){
                $category_id = intval($attributes['category_id']);
				$item->category_id = $attributes['category_id'];
            }
            $item->update();
        }
    }
	
    public function find($barcode) {
        $this->checkReadPermissions();
        $item = Item::find($barcode);
        if ($item == null) {
            return null;
        } else {
            $attributes = $item->attributesToArray();
            $attributes['itemcategory'] = $item->itemcategory->attributesToArray();
            return $attributes;
        }
    }

    public function paginate($limit = 10){
        $items = Item::paginate($limit);
        return $items;
    }

    public function findItemByCategoryId($category_id) {
        return Item::where('category_id', '=', $category_id)->get();
    }

    public function reducequantity($id,$min){
        $item = Items::find($id);
        if($item == null){
            throw new ErrorException("Invalid id");
        }
        else{
            $quantity = $item->quantity;
            if($quantity - $min >= 0){
                $item->edit(['quantity' => $item->quantity - $min]);
            }
            else{
                throw new ErrorException("Not enough stocks!");
            }
        }
    }
}

