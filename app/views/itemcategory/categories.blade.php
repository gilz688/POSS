@extends("layout")
@section("content")
<table style="width:300px">
    <tr>
        <th>Category ID</th>
        <th>Category</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    @foreach ($categories as $category)
    <tr> 
        <td> {{ $category['id'] }} </td>
        <td> {{ $category['name'] }} </td>
        <td> {{ $category['description'] }} </td>
        <td>
            <a href="{{ route('items/categories/edit', [ 'categoryId' => $category['id'] ]) }} ">edit</a>
            | 
            <a href=" {{ route('items/categories/remove', [ 'categoryId' => $category['id'] ]) }} ">remove</a>
        </td>
    </tr>
    @endforeach
</table>
<a href="{{ URL::to('items/categories/add') }}">add category</a>
@stop