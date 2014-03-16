<?php

class TransactionController extends Controller implements ResourceController{

    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository) {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Display all transactions.
     *
     * @return Response
     */
    public function index() {
        $transactions = $this->transactionRepository->all();
        return View::make('transaction.index', [
                    'transactions' => $transactions
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
        $this->transactionRepository->delete($id);
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
            $this->transactionRepository->add($transactionData);
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
        $transaction = $this->transactionRepository->find($id);
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
