@extends("layout")
@section("content")
<div class="loader"></div>
<div class="list">
<table class="table table-hover">
    <thead>
        <tr>
            <th>Category</th>
            <th>Description</th>
            <th></th>
        </tr>
    </thead>
    <tbody
        @foreach ($categories as $category)
        <tr> 
            <td> {{ $category->name }} </td>
            <td> {{ $category->description }} </td>
            <td>
                @if(Auth::user()->role == 'admin')
                {{ Form::open(['url' => 'itemcategories/' . $category->id, 'style' => 'float: left;']) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('remove', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
                &nbsp;
                <a class="btn btn-small btn-success" href="{{ URL::route('itemcategories.edit',$category->id) }} ">edit</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $categories->links() }}
</div>
<a class="btn btn-small btn-primary" href="{{ URL::route('itemcategories.create') }}">add category</a>
@stop