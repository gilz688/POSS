<?php

class Item extends Eloquent{
    protected $table = 'items';
    protected $softDelete = true;
}
