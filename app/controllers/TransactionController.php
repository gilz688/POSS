<?php

class TransactionController extends Controller implements ResourceController{

    private $transactions;

    public function __construct(TransactionRepository $transactions) {
        $this->transactions = $transactions;
    }

    /**
     * Display all transactions.
     *
     * @return Response
     */
    public function index() {       
        if(Request::ajax()){
            $paginator = $this->transactions->paginate(8);

            $options = [];
            $names = [];
            $transactions = $paginator->getItems();
                    
            foreach($transactions as $transaction){
                array_push($names,$transaction->creator->username);
                $view = View::make('entry.transaction_option', ['id' => $transaction['id'] ]);
                $contents = (string) $view;  
                array_push($options, $contents);
            }

            return Response::json([
                'transactions' => $paginator->getCollection()->toJson(),
                'links' => $paginator->links()->render(),
                'options' => $options,
                'names' => $names
            ]);
        }
 
        return View::make('transaction.index');
    }

    /**
     * Show the form for creating a new transaction.
     *
     * @return Response
     */
    public function create() {		
			$data['error'] = Input::get("error");
			return View::make('transaction.create',$data);

		
		//$transactionData['cashier_number'] = Input::get('cashier_number');                
        //$transactionData['id'] = $this->transactionRepository->add($transactionData);
        //return View::make('purchaseditem.create', $transactionData);
    }

    /**
     * Mark the specified transaction as void.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $this->transactions->delete($id);
        return Redirect::route('transactions.index');
    }

    /**
     * Store a newly created transaction in storage.
     *
     * @return Response
     */
    public function store() {
		
			
			$cashier_number = Input::get('cashier_number');
			$quantity = Input::get('quantity');
			$barcode = Input::get('barcode');
			
			$itemRepo = new ItemRepository;
			$item = $itemRepo->find($barcode);
			
			
			
			if($item == null){
				return Response::json([
					'error'=> "invalid barcode",
				]);
			}
			
			if(($quantity % 1) == $quantity ){
				return Response::json([
					'error'=> "invalid quantity",
				]);
			}
		
			if($item['quantity'] < $quantity){
				return Response::json([
					'error'=> "not enough stocks left",
				]);
			}
			
			$response = array(
				'quantity' => $quantity,
				'itemName' => $item['itemName'],
				'price' => $item['price'],
				'amount' => $item['price'] * $quantity
			);
			
			
			return Response::json( $response );
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $transaction = $this->transactions->find($id);
        $items = $transaction['purchasedItems'];
		$itemAmountAndName = $this->transactions->getAmount($items);

        $totalTransaction = $this->transactions->getTotal($id);
        return View::make('transaction.show', [
            'items' => $items,
            'amountAndName' => $itemAmountAndName,
            'transaction' => $totalTransaction,
        ]);
    }

    public function update($id){

    }

    public function edit($id){
         return View::make('transaction.edit', $id);
    }

}

