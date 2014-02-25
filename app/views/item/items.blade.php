@extends("layout")
@section("content")
<table>
    <tr>
        <th>Barcode</th>
        <th>Name</th>
        <th>Price</th>
		<th>Description</th>
		<th>Size/Weight</th>
		<th>Category</th>
		<th>Action</th>
		
    </tr>
    @foreach ($items as $item)
    <tr> 
        <td> {{ $item->barcode }} </td>
        <td> {{ $item->name }} </td>
		<td> {{ $item->price }} </td>
        <td> {{ $item->description }} </td>
		<td> {{ $item->size_or_weight }} </td>
        <td> {{ $item->category_id }} </td>
        <td>
        @if ($item->username != $username)
            <a href="{{ route('items/remove', [ 'itemBarcode' => $item->barcode ]) }}">remove</a> 
        @endif
        </td>
    </tr>
    @endforeach
</table>
<a href="{{ URL::to('items/add') }}">add item</a>
@stop