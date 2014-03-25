<?php

class Item extends Eloquent{
    protected $table = 'items';
    protected $primaryKey = 'barcode';
    protected $softDelete = true;

    public function itemCategory(){
        return $this->belongsTo('ItemCategory','category_id');
    }
}
