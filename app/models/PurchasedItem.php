<?php

class PurchasedItem extends Eloquent{
    protected $table = 'purchased_items';
    protected $softDelete = true;
    
    public function transaction()
    {
        return $this->belongsTo('Transaction');
    }

    public function item(){
    	return $this->belongsTo('Item','barcode','barcode');
    }
}
