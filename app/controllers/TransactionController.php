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
        return View::make('transaction.index', [
                    'transactions' => $this->transactions->paginate()
        ]);
    }

    /**
     * Show the form for creating a new transaction.
     *
     * @return Response
     */
    public function create() {
        return View::make('transaction.create');
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
        try {
            $transactionData = [
                'cashier_number' => Input::get('cashierNumber')
            ];
            $this->transactions->add($transactionData);
            return Redirect::route('transactions.index');
        } catch (UnauthorizedException $ex) {
            echo $ex->getMessage();
        }
        return Redirect::route('transactions.index');
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
        return View::make('transaction.show', [
                    'items' => $items
        ]);
    }

    public function update($id){

    }

    public function edit($id){
        
    }

}
