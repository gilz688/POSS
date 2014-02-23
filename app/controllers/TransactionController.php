<?php

class TransactionController extends Controller{

    private $transactionRepository;

    public function __construct() {
        $this->transactionRepository = new TransactionRepository;
    }

    public function listAction() {
        $transactions = $this->transactionRepository->all();
        return View::make('transaction/list', array(
            'transactions' => $transactions
        ));
    }
    
    /*
     *  Mark transaction as void.
     */
    public function voidAction() {
        $transactionId = Input::get('transactionId');
        $this->transactionRepository->delete($transactionId);
        return Redirect::route('transactions');
    }
    
    public function addAction() {
        if (Input::server('REQUEST_METHOD') == 'POST')
        {
            try{
                $transactionData = [
                    'cashier_number' => Input::get('cashierNumber')
                ];
                $this->transactionRepository->add($transactionData);
                return Redirect::route('transactions');
            } catch (UnauthorizedException $ex) {
                echo $ex->getMessage();
            }
        }
        
        return View::make('transaction/add');
    }
}
