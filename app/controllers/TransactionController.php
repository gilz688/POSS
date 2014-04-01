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
			Session::put('purchaseditems',[]);
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

public function store(){

}
    /**
     * Store a newly created transaction in storage.
     *
     * @return Response
     */

    public function done() {
		
			$transactionData['payment'] = Input::get('payment'); 
			$transactionData['total'] = Input::get('total'); 
			$transactionData['change'] = $transactionData['payment'] - $transactionData['total'] ; 
			if(!is_numeric($transactionData['payment'])){
				return Response::json([
					'error'=> "invalid payment",
				]);
			}
			
			if($transactionData['payment'] < $transactionData['total']){
				return Response::json([
					'error'=> "insufficient payment",
				]);
			}
        
            $transactionData['cashier_number'] = Session::get('cashier_number'); 
            $items = (array)Session::get('purchaseditems');
            /*$items = Input::get('items');*/
                   
            $transactionData['id'] = $this->transactions->add($transactionData); 
            $purchaseditems = new PurchasedItemRepository;
            
            foreach($items as $item){
				$pData['id'] =  $transactionData['id'];
				
				$pData['barcode'] =  $item['barcode'];
				$pData['quantity'] =  $item['quantity'];

				
				$purchaseditems->add($pData);      
			}
        
        Session::forget('purchaseditems');
        
        $response = array(
        'resp' => 'OK'
        
        );
		return Response::json($response);
    }
    
    
        public function transactionStore() {
		
			
			//$cashier_number = Session::get('cashier_number');
			//if($cashier_number == null ){
			//	Session::put('cashier_number',1);
			//	$cashier_number = Session::get('cashier_number');
			//}
			$cashier_number = Session::get('cashier_number');
			$quantity = Input::get('quantity');
			$barcode = Input::get('barcode');
			
			$itemRepo = new ItemRepository;
			
			if(!is_numeric($barcode)){
				return Response::json([
					'error'=> "invalid barcode",
				]);
			}
			
			$item = $itemRepo->find($barcode);
			
			
			
			if($item == null){
				return Response::json([
					'error'=> "invalid barcode",
				]);
			}
			
			if(!is_numeric($quantity) ){
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
				'amount' => $item['price'] * $quantity,
				'barcode' => $barcode
			);
			
			$items = (array)Session::get('purchaseditems');
			array_push($items,[
				'barcode' => $barcode,
				'quantity' => $quantity
			]);
			Session::put('purchaseditems',$items);
			
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

