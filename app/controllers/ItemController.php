<?php

class ItemController extends Controller{

private $items;

    public function __construct(ItemRepository $items) {
        $this->items = $items;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return View::make('item.index', array(
                    'items' => $this->items->all()
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $itemData = [
			'barcode' => Input::get('barcode'),
            'itemName' => Input::get('itemName'),
			'price' => Input::get('price'),
			'quantity' => Input::get('quantity'),
            'itemDescription' => Input::get('itemDescription'),
			'label' => Input::get('label'),
			'category_id' => Input::get('category_id'),
        ];
        $rules = array(
			'barcode' => 'required',
            'itemName' => 'required',
			'price' => 'required',
			'quantity' => 'required',
            'itemDescription' => 'required',
			'label' => 'required',
			'category_id' => 'required',
        );
        $validator = Validator::make($itemData, $rules);

        if ($validator->fails()) {
            return Redirect::to('items/create')
                            ->withErrors($validator)
                            ->withInput(Input::all());
        }
        $this->items->add($itemData);
        Session::flash('message', 'Successfully added new item!');
        return Redirect::route('items.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  bigint  $barcode
     * @return Response
     */
    public function edit($barcode) {
        $itemData = $this->items->find($barcode);
        return View::make('item.edit', $itemData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  bigint  $barcode
     * @return Response
     */
    public function update($barcode) {
        $itemData = [
			'itemName' => Input::get('itemName'),
			'price' => Input::get('price'),
			'quantity' => Input::get('quantity'),
            'itemDescription' => Input::get('itemDescription'),
			'label' => Input::get('label'),
        ];
        $rules = [
            'itemName' => '',
			'price' => '',
			'quantity' => '',
            'itemDescription' => '',
			'label' => '',
        ];
        $validator = Validator::make($itemData, $rules);
        if ($validator->fails()) {
            return Redirect::to('items/' . $barcode . '/edit')
                            ->withErrors($validator)
                           ->withInput(Input::all());
        }
        $this->items->edit($barcode, $itemData);
        return Redirect::route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  bigint  $barcode
     * @return Response
     */
    public function destroy($barcode) {
        $this->items->delete($barcode);
        return Redirect::route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  bigint  $barcode
     * @return Response
     */
    public function show($barcode) {
        
    }
}