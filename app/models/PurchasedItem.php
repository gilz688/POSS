<?php

class PurchasedItem extends Item{
    protected $table = 'purchased_items';
    protected $softDelete = true;
}
