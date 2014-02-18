<!DOCTYPE html>
<html>
	<head>
		<title>Point Of Sale System</title>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">

			<nav class="navbar navbar-inverse">
				<div class="navbar-header">
					<a class="navbar-brand" href="{{ URL::to('items') }}">Point Of Sale System</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="{{ URL::to('items') }}">View All Items</a></li>
					<li><a href="{{ URL::to('items/create') }}">Create an Item</a>
				</ul>
			</nav>

			<h1>Create an Item</h1>

			<!-- magdisplay ug error if naa -->
			{{ HTML::ul($errors->all()) }}

			{{ Form::open(array('url' => 'items')) }}
			
				<div class="form-group">
					{{ Form::label('barcode', 'Barcode') }}
					{{ Form::numeric('barcode', Input::old('barcode'), array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::label('name', 'Name') }}
					{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::label('description', 'Description') }}
					{{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::label('size_or_weight', 'Size/Weight') }}
					{{ Form::text('size_or_weight', Input::old('size_or_weight'), array('class' => 'form-control')) }}
				</div>
				
				<div class="form-group">
					{{ Form::label('category_id', 'Category ID') }}
					{{ Form: numeric('category_id', Input::old('category_id'), array('class' => 'form-control')) }}
				</div>

				{{ Form::submit('Create the Item!', array('class' => 'btn btn-primary')) }}

			{{ Form::close() }}

		</div>
	</body>
</html>