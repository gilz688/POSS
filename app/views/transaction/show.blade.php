@extends("layout")
@section("content")
<table class="table table-hover">
    <thead>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
    <thead>
    <tbody>
        @foreach($items as $item)
        <tr> 
            <td> {{ $item['barcode'] }} </td>
			<td> {{ $item['quantity'] }} </td>
			<td>
				@if(Auth::user()->role == 'admin')
                {{ Form::open(['url' => 'transactions/' . $item['barcode'], 'style' => 'float: left;']) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('remove', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
                &nbsp;
                <a class="btn btn-small btn-success" href="{{ URL::route('items.edit',$item['barcode']) }} ">edit</a>
                @endif
			</td>
        @endforeach
    </tbody>
</table>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
            @foreach($amount as $value)
            <tr>
                <td> {{ $value }} </td>
            @endforeach
            </tr>
    </tbody>
</table>
Total Sales: {{ $transaction['sales'] }}
@stop
