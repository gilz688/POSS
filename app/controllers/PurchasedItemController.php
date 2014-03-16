<?php 

class PurchasedItemController extends Controller{
	
	private $items;
	
	public function __construct(PurchasedItemRepository $items){
		$this->items = $items;
	}
	
	public function index(){
		return View::make(
			'purchaseditem.index', 
			array(
				'purchaseditems' => $this->items->all()
			));		
	}
	
	    /**
     * Display the specified resource.
     *
     * @param  bigint  $barcode
     * @return Response
     */
    public function show($barcode) {
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('purchaseditem.create');
    }

	 /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $itemData = [
			'barcode' => Input::get('barcode'),
			'quantity' => Input::get('quantity'),
			'transaction_id' => Input::get('transaction_id')
        ];
        $rules = array(
			'barcode' => 'required',
			'quantity' => 'required',
			'transaction_id' => 'required',
        );
        $validator = Validator::make($itemData, $rules);

        if ($validator->fails()) {
            return Redirect::to('purchaseditems/create')
                            ->withErrors($validator)
                            ->withInput(Input::all());
        }
        $this->items->add($itemData);
        Session::flash('message', 'Successfully added new item!');
        return Redirect::route('purchaseditems.index');
    }
	
	/**
     * Show the form for editing the specified resource.
     *
     * @param  bigint  $barcode
     * @return Response
     */
    public function edit($barcode) {
        $itemData = $this->items->find($barcode);
        return View::make('purchaseditem.edit', $itemData);
	}

	/**
     * Update the specified resource in storage.
     *
     * @param  bigint  $barcode
     * @return Response
     */
    public function update($barcode) {
        $itemData = [
			'quantity' => Input::get('quantity'),
        ];
        $rules = [
			'quantity' => 'required',
        ];
        $validator = Validator::make($itemData, $rules);
        if ($validator->fails()) {
            return Redirect::to('purchaseditems/' . $barcode . '/edit')
                            ->withErrors($validator)
                           ->withInput(Input::all());
        }
        $this->items->edit($barcode, $itemData);
        return Redirect::route('purchaseditems.index');
	}
	
	   /**
     * Remove the specified resource from storage.
     *
     * @param  bigint  $barcode
     * @return Response
     */
    public function destroy($barcode) {
        $this->items->delete($barcode);
        return Redirect::route('purchaseditems.index');
    }
}
