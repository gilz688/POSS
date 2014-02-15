<?php

class Transaction extends Eloquent{
    protected $table = 'transactions';
    protected $softDelete = true;
}
