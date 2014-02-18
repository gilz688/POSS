<?php

class ItemController extends BaseController{

	/**
	 *Display a listing of resource
	 *@return Response
	 */
	 public function index(){
		//get all items
		$items = Item::all();
		
		//load the view and pass items
		return View::make('items.create') -> with('items', $items);
	 }
	 /**
	  * Store a newly created resource
	  * @return Response
	  */
	 public function store(){
		//validate
		$rules = array(
			'barcode'        => 'required',
			'name'           => 'required',
			'description'    => 'required',
			'size_or_weight' => 'required',
			'category_id'    => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		//check
		if($validator -> fails()){
			return Redirect::to('items/create')
				-> withErrors($validator)
				-> withInput(Input::except('password'));
		}
		else{
			//store item
			$item = new Item;
			$item->barcode = Input:get('barcode');
			$item->name = Input::get('name');
			$item->description = Input::get('description');
			$item->size_or_weight = Input::get('size_or_weight');
			$item->category_id = Input::get('category_id');
			$item->save();
			
			Session::flash('message', 'Item was succesfully created!');
			return Redirect::to('items');
		}
	 }
	 
	 /**
	  * Display specified resource
	  * @param int $barcode
	  * @return Response
	 */
	 public function show($barcode){
		//get item
		$item = Item::find($barcode);
		//pass item to the view
		return View::make('items.show') -> ('item', $item);
	 }
	 /**
	  * Edit item
	 */
	 public function edit(){
		//wala pa
	 }
	 /**
	  * Update item
	  * Process the create form submit and save the nerd to the database.
	 */
	 public function update(){
	 //wala pa sad
	 }
	 
	 /**
	  * Remove specified resource from storage
	  * @param int $barcode
	  * @return Response
	 */
	 public function destroy($barcode){
		//delete item
		$item = Item::find($barcode);
		$item->delete();
		//view message
		Session::flash('message', 'Item was successfully deleted! ');
		return Redirect::to('items');
	 }
}