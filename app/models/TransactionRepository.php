<?php

class PurchasedItemRepository implements TableRepository{

    public function add($attributes) {
        // some code here
    }

    public function delete($id) {
        // some code here to soft delete transaction
    }

    public function all() {
        // some code here
        return Transaction::all();
    }

    public function edit($id, $attributes) {
        throw new IllegalOperationException('Editing transactions is not allowed!');
    }
    
    public function find($id) {
        // some code here
    }
}
