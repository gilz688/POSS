@extends("layout")
@section("content")
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
            <td> {{ $transaction['id'] }} </td>
            <td> {{ $transaction['cashier_number'] }} </td>
            <td> {{ $transaction['creator_id'] }} </td>
            <td>
                @if(Auth::user()->role == 'auditor')
                {{ Form::open(['url' => 'transactions/' . $transaction['id'], 'style' => 'float: left;']) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('void', ['class' => 'btn btn-warning']) }}
                {{ Form::close() }}
                @endif
                &nbsp;
                <a class="btn btn-small btn-info" href="{{ URL::route('transactions.show',$transaction['id']) }} ">view invoice</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@if(Auth::user()->role == 'clerk')
<a class="btn btn-small btn-primary" href="{{ URL::route('transactions.create') }}">Add Transaction</a>
@endif
@stop
