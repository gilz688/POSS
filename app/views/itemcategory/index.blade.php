@extends("layout")
@section("content")

<a class="btn btn-small btn-danger" href="{{ URL::route('itemcategories.create') }}"><i class="glyphicon glyphicon-plus"></i>  ADD CATEGORY</a>
<br>
<br>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Category</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    <thead>
    <tbody
        @foreach ($categories as $category)
        <tr> 
            <td> {{ $category['name'] }} </td>
            <td> {{ $category['description'] }} </td>
            <td>
                @if(Auth::user()->role == 'admin')
                {{ Form::open(['url' => 'itemcategories/' . $category['id'], 'style' => 'float: left;']) }}
                {{ Form::hidden('_method',  'DELETE') }}
                <form method="POST" action="http://localhost:8000/items/index" accept-charset="UTF-8" style="display:inline">
                    <button class="btn btn-small btn-danger" type="submit" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Item" data-message="Are you sure you want to delete this item ?">
                        <i class="glyphicon glyphicon-trash"></i>  DELETE
                    </button>
                {{ Form::close() }}
                &nbsp;
                <a class="btn btn-small btn-success" href="{{ URL::route('itemcategories.edit',$category['id']) }} "><i class="glyphicon glyphicon-edit"></i>  EDIT</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop