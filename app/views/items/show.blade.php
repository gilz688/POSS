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
				<ul class="nav navbar-nav">
					<li><a href="{{ URL::to('items') }}">View All Items</a></li>
					<li><a href="{{ URL::to('items/create') }}">Create an Item</a>
				</ul>
			</nav>

			<h2>Showing {{ $item->name }}</h2>

				<div class="jumbotron text-center">
					<p>
						<strong>Barcode:</strong>     {{ $item->barcode }}
						<strong>Name:</strong>        {{ $item->name }}
						<strong>Description:</strong> {{ $item->description }}
						<strong>Size/Weight:</strong> {{ $item->size_or_weight }}
						<strong>Category ID:</strong> {{ $item->category_id }}
					</p>
				</div>

		</div>
	</body>
	@section(footer)
</html>