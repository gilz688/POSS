@extends("layout")
@section("content")
<table class="table table-hover">
    <thead>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    <thead>
    <tbody
        @foreach ($items as $item)
        <tr> 
            <td> {{ $item['barcode'] }} </td>
			<td> {{ $item['quantity'] }} </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop