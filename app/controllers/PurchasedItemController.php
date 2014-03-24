<?php 

class PurchasedItemController extends Controller{
	
	private $items;
	private $array_items;
	
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
     * 
     * @return Response
     */
    public function show() {
		Session::put('pItems', $this->array_items);
		$pItems = Session::get('pItems');
		
		foreach($pItems as $item){
			echo $item['barcode'];
		}
		
		
		//return View::make('purchaseditem.show',$pItems);
        //return View::make('purchaseditem.show',['purchaseditems' => $this->array_items]);
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
			'quantity' => Input::get('quantity')
        ];
        $rules = array(
			'barcode' => 'required',
			'quantity' => 'required'
        );
        $validator = Validator::make($itemData, $rules);

        if ($validator->fails()) {
            return Redirect::to('purchaseditems/create')
                            ->withErrors($validator)
                            ->withInput(Input::all());
        }
        else{
			$array_items[] = $itemData;
			$this->items->add($itemData);
			return View::make('purchaseditem.create');
		}
        
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
