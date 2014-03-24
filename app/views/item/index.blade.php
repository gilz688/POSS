@extends("layout")
@section("content")
<head>
	<!--modal scripts-->
	<link rel="stylesheet" href="css/modal.css" type="text/css" />
        <link rel="stylesheet" href="css/carousel.css" type="text/css" />
        <script type="text/javascript" src="script/jquery-1.5.min.js"></script>
        <script type="text/javascript" src="script/jquery.ez-bg-resize.js"></script>
        <script type="text/javascript" src="script/carousel.js"></script>
        <script type="text/javascript" src="script/jqitem.js"></script>
</head>

<a class="btn btn-small btn-danger" href="{{ URL::route('items.create') }}"><i class="glyphicon glyphicon-plus"></i>  ADD ITEM</a>
<br>
<br>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
			<th>Label</th>
            <th>Option</th>
        </tr>
    <thead>
    <tbody>
        @foreach ($items as $item)
        <tr> 
            <td> <span style="font-weight: bold; font-family: sans-serif;">{{ HTML::link('items/' . $item['barcode'], $item['itemName']) }} <span/> </td>
            <td> {{ $item['itemcategory']['name'] }} </td>
			<td> {{ $item['label'] }} </td>
            <td>
                @if(Auth::user()->role == 'admin')

                {{ Form::open(['url' => 'items/' . $item['barcode'], 'style' => 'float: left;']) }}
				<!--{{ Form::hidden('_method', 'DELETE') }} -->
				{{ Form::open(array(
							'route' => array('items.destroy', $item->barcode),
							'method' => 'delete',
							'style' => 'display:inline'
						))
				 }}
				 
				<form method="POST" action="http://localhost:8000/items/index" accept-charset="UTF-8" style="display:inline">
					<button class="btn btn-small btn-danger" onClick="return false;" type="submit"  data-toggle="modal" data-target="#confirmDelete"><!-- data-title="Delete Item" data-message="Are you sure you want to delete this item ?"-->
						<i class="glyphicon glyphicon-trash"></i> DELETE
					</button>
				</form>
				
                {{ Form::close() }}
                &nbsp;
                <a class="btn btn-small btn-success" href="{{ URL::route('items.edit',$item['barcode']) }} "><i class="glyphicon glyphicon-edit"></i>  EDIT</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination">
{{ $items->links() }}
</div>
@include('item.delete_confirm')
@stop