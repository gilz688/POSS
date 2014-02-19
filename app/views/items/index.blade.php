<!DOCTYPE html>

<html>
@section("header")
	
	<!--	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"> -->

	
	<body>
		<div class="container">
			<nav class="navbar navbar-inverse">
				<div class="navbar-header">
					<a class="navbar-brand" href="{{ URL::to('items') }}">Point of Sale System</a>
				</div>
				<ul class="nav nabar-nav">
					<li><a href="{{ URL::to('items') }}">View All Items</a></li>
					<li><a href="{{ URL::to('items/create') }}">Create an Item</a>
				</ul>
			</nav>
			
			<h1> All Items</h1>
			<!--  messages -->
			@if (Session::has('message'))
				<div class="alert alert-info">{{ Session::get('message') }}</div>
			@endif

			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<td>Barcode</td>
						<td>Name</td>
						<td>Description</td>
						<td>Size/Weight</td>
						<td>Category ID</td>
						<td>Actions</td>
					</tr>
				</thead>
				<tbody>
				@foreach($items as $key => $value)
					<tr>
						<td>{{ $value->barcode }}</td>
						<td>{{ $value->name }}</td>
						<td>{{ $value->description }}</td>
						<td>{{ $value->size_or_weight }}</td>
						<td>{{ $value->category_id }}</td>

						<!-- buttons -->
						<td>
							<!-- show button  -->
							<a class="btn btn-small btn-success" href="{{ URL::to('items/' . $value->barcode }}">Show</a>

							<!-- edit button-->
							<a class="btn btn-small btn-info" href="{{ URL::to('items/' . $value->barcode . '/edit') }}">Edit</a>

							<!-- delete -->
							{{ Form::open(array('url' => 'items/' . $value->barcode, 'class' => 'pull-right')) }}
								{{ Form::hidden('_method', 'DELETE') }}
								{{ Form::submit('Delete this item', array('class' => 'btn btn-warning')) }}
							{{ Form::close() }}
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</body>
	@section(footer)
</html>