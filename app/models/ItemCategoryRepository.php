<?php

class ItemCategoryRepository implements TableRepository {

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
        null => true
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
        $rules = [ 'name' => 'required|Unique:item_categories',
            'description' => 'required'];
        $validator = Validator::make($attributes, $rules);
        if ($validator->passes()) {
            $category = new ItemCategory;
            $category->name = $attributes['name'];
            $category->description = $attributes['description'];
            $category->save();
            return $category->id;
        } else {
            throw new ErrorException("Invalid data!");
        }
    }

    public function delete($id) {
        $this->checkWritePermissions();
        $category = ItemCategory::find($id);
        if ($category != null) {
            $category->delete();
        } else {
            throw new ErrorException("Invalid id!");
        }
    }

    public function all() {
        $this->checkReadPermissions();
        return ItemCategory::orderBy('id')->get();
    }

    public function edit($id, $attributes) {
        $this->checkWritePermissions();
        $itemCategory = ItemCategory::find($id);
        if ($id == null) {
            throw new ErrorException("Invalid id!");
        } else {
            if(array_key_exists('name',$attributes)){
                $name = $attributes['name'];
                if(gettype($name) == 'string'){
                    $itemCategory->name = $attributes['name'];
                }
                else{
                    throw new ErrorException('Name should be a string!');
                }
            }
            if(array_key_exists('description',$attributes)){
                $description = $attributes['description'];
                if(gettype($description) == 'string'){
                    $itemCategory->description = $attributes['description'];
                }
                else{
                    throw new ErrorException('Description should be string!');
                }
            }
            $itemCategory->update();
        }
    }
    
    public function find($id) {
        $this->checkReadPermissions();
        $itemCategory = ItemCategory::find($id);
        if ($itemCategory == null) {
            return null;
        } else {
            return $itemCategory->attributesToArray();
        }
    }
}
