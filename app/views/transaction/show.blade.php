@extends("layout")
@section("content")
<table class="table table-hover">
    <thead>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        <tr>Total Sales: </tr>
    <thead>
    <tbody>
        @for($i=0; $i < count($items); $i++)
        <tr> 
            <td> {{ $item['barcode'] }} </td>
			<td> {{ $item['quantity'] }} </td>
            <td> {{ $amount }} </td>
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
        <tr> {{ $transaction['sales'] }} </tr>
    </tbody>
</table>
@stop
