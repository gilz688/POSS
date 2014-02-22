<?php

class PurchasedItemsRepository implements TableRepository{

    public function add($attributes) {
        // some code here
    }

    public function delete($id) {
        throw new IllegalOperationException('Editing transactions is not allowed!');
    }

    public function all() {
        // some code here
        return PurchasedItem::all();
    }

    public function edit($id, $attributes) {
        throw new IllegalOperationException('Editing transactions is not allowed!');
    }
    
    public function find($id) {
        // some code here
    }
}
