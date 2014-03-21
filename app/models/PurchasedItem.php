<?php

class PurchasedItem extends Eloquent{
    protected $table = 'purchased_items';
    protected $softDelete = true;
    
    public function transaction()
    {
        return $this->belongsTo('Transaction','id','transaction_id');
    }

    public function item(){
    	return $this->belongsTo('Item','barcode','barcode');
    }
}
