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

    public function add($attributes) {
        $this->checkWritePermissions();
        // some code here
    }

    public function delete($id) {
        $this->checkWritePermissions();
        // some code here
    }

    public function all() {
        $this->checkReadPermissions();
        return Item::all();
    }

    public function edit($id, $attributes) {
        $this->checkWritePermissions();
        // some code here
    }
    
    public function find($id) {
        $this->checkReadPermissions();
        // some code here
    }
}
