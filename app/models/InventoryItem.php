<?php

class InventoryItem extends Item{
    protected $table = 'inventory_items';
    protected $softDelete = true;
}
