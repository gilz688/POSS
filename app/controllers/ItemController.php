<?php

class ItemController extends Controller implements ResourceController{

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
        if(Request::ajax()){
            $paginator = $this->items->paginate(8);

            $options = [];
            $names = [];
            $items = $paginator->getItems();
                    
            foreach($items as $item){
                array_push($names,$item->itemcategory->name);
                $view = View::make('entry.item_option', ['barcode' => $item['barcode'] ]);
                $contents = (string) $view;  
                array_push($options, $contents);
            }

            return Response::json([
                'items' => $paginator->getCollection()->toJson(),
                'links' => $paginator->links()->render(),
                'options' => $options,
                'names' => $names
            ]);
        }
 
        return View::make('item.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //echo '<script type="text/javascript">alert("Add Item !");</script>';
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
		try{
			if ($validator->passes()) {
				$this->items->add($itemData);
				Session::flash('message', 'Successfully added new item!');
				return Redirect::route('items.index');
			}
		}
		catch(\Exception $e){
			return Redirect::to('items/create' );
			//echo 'Error!! Invalid input!';
			Session::flash('message', 'Error!!');
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
		try{
			if ($validator->passes()) {
				$this->items->edit($barcode, $itemData);
				return Redirect::route('items.index');
				Session::flash('message', 'Successfully added new item!');
				
			}
		}
		catch(\Exception $e){
			return Redirect::to('items/' . $barcode . '/edit');
			//echo 'Error!! Invalid input!';
			Session::flash('message', 'Error!! Invalid input!');
		}
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  bigint  $barcode
     * @return Response
     */
    public function destroy($barcode) {
        try{
            $this->items->delete($barcode);
        } catch(ErrorException $e){

        }

        if(Request::ajax()){
            echo 'true'; 
        }
        else{
            return Redirect::route('items.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  bigint  $barcode
     * @return Response
     */
    public function show($barcode) {
        return View::make('item.show', [
                    'item' => $this->items->find($barcode)
        ]);
    }
}
