@extends("layout")
@section("content")


<table class="table table-hover">
    <thead>
        <tr>
            <th>Barcode</th>
            <th>Quantity</th>
        </tr>
    <thead>
    <tbody>
        @foreach ($items as $item)
        <tr> 
			<td> {{ $item['barcode'] }} </td>
            <td> {{ $item['quantity'] }} </td>
            <td>
                @if(Auth::user()->role == 'admin')
                {{ Form::open(['url' => 'purchaseditems/' . $item['barcode'], 'style' => 'float: left;']) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('remove', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
                &nbsp;
                
                 <a class="btn btn-small btn-success" href="{{ URL::route('purchaseditems.edit',$item['barcode']) }} ">edit</a> 
                @endif
            </td> 
        </tr>
        @endforeach
    </tbody>
</table>
<a class="btn btn-small btn-primary" href="{{ URL::route('purchaseditems.create') }}">add item</a>
@stop
