<?php
use Carbon\Carbon;
class TransactionRepository implements TableRepository {

    public function add($attributes) {
        if (Auth::user()->role == 'clerk') {
            $rules = [
                'cashier_number' => 'required'
            ];
            $validation = Validator::make($attributes, $rules);
            if ($validation->passes()) {
                $transaction = new Transaction;
                $transaction->cashier_number = $attributes['cashier_number'];
                $transaction->creator_id = Auth::getUser()->id;
                $transaction->save();
                return $transaction->id;
            } else {
                throw new ErrorException('Cashier number is required!');
            }
        } else {
            throw new UnauthorizedException('Only clerks are allowed to add transactions!');
        }
    }

    public function delete($id) {
        if (Auth::user()->role == 'auditor') {
            $transaction = Transaction::find($id);
            if ($transaction == null) {
                throw new ErrorException('Invalid transaction id!');
            } else {
                $transaction->delete();
            }
        } else {
            throw new UnauthorizedException('Only auditors are authorized to void transactions');
        }
    }

    public function all(array $columns = ["*"]) {
        switch (Auth::user()->role) {
            case 'admin': case 'auditor':
                return Transaction::all();
            case 'clerk':
                return Transaction::where('creator_id', Auth::user()->id)->get($columns);
            default:
                throw new UnauthorizedException('Read access to table repository is denied!');
        }
    }

    public function edit($id, $attributes) {
        throw new IllegalOperationException('Editing transactions is not allowed!');
    }

    public function find($id) {
        $role = Auth::user()->role;
        switch ($role) {
            case 'admin': case 'auditor': case 'clerk':
                $transaction = Transaction::find($id);
                if ($transaction == null) {
                    return null;
                }
                if($role == 'clerk' && $transaction->creator_id != Auth::user()->id){
                    throw new UnauthorizedException('Clerks can only view the transactions they created!');
                }
                $transaction['purchasedItems'] = $transaction->purchasedItems->toArray();
                return $transaction->attributesToArray();
            default:
                throw new UnauthorizedException('Read access to table repository is denied!');
        }
    }

    public function get(Carbon $start, Carbon $end){
        if(Auth::user()==null){
            throw new UnauthorizedException('Read access to table repository is denied!');
        }
        $role = Auth::user()->role;
        $id = Auth::user()->id;
        switch ($role) {
            case 'admin': case 'auditor':
                return Transaction::whereBetween('created_at',[$start,$end])->orderBy('created_at')->get();
            case 'clerk':
                return Transaction::whereBetween('created_at',[$start,$end])->orderBy('created_at')->get();
            default:
                throw new UnauthorizedException('Read access to table repository is denied!');
        }
    }

    public function getTotal($id){
        $transaction = Transaction::find($id);
        if($transaction == null){
            throw new ErrorException('Invalid transaction id');
        }
        else{
            $items = $transaction->purchasedItems;
            $sales = 0.00;
            foreach($items as $item){
                $sales += $item->item->price * $item->quantity;
            }
            return ['items' => count($items), 'sales' => $sales];
        }
    }


    public function getAmount($items) {
        $array = [];
        $amount = 0.0;
        $a = new ItemRepository;
        foreach($items as $item) {
            $find = $a->find($item['barcode']);
            $price = $find['price'];
            $quantity = $item['quantity'];
            $amount = $quantity * $price;
            $array[] = $amount;
        }
        return $array;
    }

    public function paginate($limit = 10){
        $items = Transaction::paginate($limit);
        return $items;
    }
}
