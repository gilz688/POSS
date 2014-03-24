@extends("layout")
@section("content")




@if(Auth::user()->role == 'clerk')

	@if(Session::get('cashier_number') == null)
		<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#addTransaction">Add Transaction</button>
	@endif
	@if(Session::get('cashier_number') != null)
		<a href="/transactions" class="btn btn-xs btn-default active" role="button">Add Transaction</a>
	@endif
@endif
<br/>
<br/>
<div class="loader"></div>
<div class="list">
<table class="table table-hover">
    <thead
        <tr>
            <th>Transaction ID</th>
            <th>Cashier Number</th>
            <th>Creator</th>
            <th></th>
        </tr>
    </thead>
    <tbody

        @foreach ($transactions as $transaction)
        <tr> 
            <td> {{ $transaction->id }} </td>
            <td> {{ $transaction->cashier_number }} </td>
            <td> {{ $transaction->creator_id }} </td>
            <td>
                @if(Auth::user()->role == 'auditor')
                {{ Form::open(['url' => 'transactions/' . $transaction['id'], 'style' => 'float: left;']) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('void', ['class' => 'btn btn-warning']) }}
                {{ Form::close() }}
                @endif
                &nbsp;
                <a class="btn btn-small btn-info" href="{{ URL::route('transactions.show',$transaction->id) }} ">view invoice</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@include('transaction.addCashier')
@stop
