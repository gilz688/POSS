@extends("layout")
@section("content")
<table class="table table-hover">
    <thead>
    <tr>
        <th>Category ID</th>
        <th>Category</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    <thead>
    <tbody
    @foreach ($categories as $category)
    <tr> 
        <td> {{ $category['id'] }} </td>
        <td> {{ $category['name'] }} </td>
        <td> {{ $category['description'] }} </td>
        <td>
            {{ Form::open(['url' => 'itemcategories/' . $category['id'], 'style' => 'float: left;']) }}
		{{ Form::hidden('_method', 'DELETE') }}
		{{ Form::submit('remove', ['class' => 'btn btn-warning']) }}
            {{ Form::close() }}
            &nbsp;
            <a class="btn btn-small btn-success" href="{{ URL::route('itemcategories.edit',$category['id']) }} ">edit</a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<a class="btn btn-small btn-primary" href="{{ URL::route('itemcategories.create') }}">add category</a>
@stop