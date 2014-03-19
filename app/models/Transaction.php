<?php

class Transaction extends Eloquent {

    protected $table = 'transactions';
    protected $softDelete = true;

    public function purchasedItems() {
        return $this->hasMany('PurchasedItem', 'id', 'id');
    }
    
    public function creator(){
        return $this->belongsTo('User','creator_id','id');
    }
    
    public function voider(){
        return $this->belongsTo('User','creator_id','id');
    }
}
