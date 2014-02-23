@extends("layout")
@section("content")
<table style="width:300px">
    <tr>
        <th>Transaction ID</th>
        <th>Cashier Number</th>
        <th>Creator</th>
        <th>Action</th>
    </tr>
    @foreach ($transactions as $transaction)
    <tr> 
        <td> {{ $transaction['id'] }} </td>
        <td> {{ $transaction['cashier_number'] }} </td>
        <td> {{ $transaction['creator_id'] }} </td>
        <td>
            <a href="{{ route('transactions/view', [ 'transactionId' => $transaction['id'] ]) }} ">view</a>
            | 
            <a href=" {{ route('transactions/void', [ 'transactionId' => $transaction['id'] ]) }} ">void</a>
        </td>
    </tr>
    @endforeach
</table>
<a href="{{ URL::to('transactions/add') }}">add transaction</a>
@stop