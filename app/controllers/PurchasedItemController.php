<?php

class PurchasedItemController extends Controller {

    private $items;

    public function __construct(PurchasedItemRepository $items){
    	$this->items = $items;
    }

    public function index(){
    	return View::make('purchaseditem.index', array(
                    'items' => $this->items->all()
        ));
    }

    public function destroy($id){

    }
}