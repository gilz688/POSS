@extends("layout")
@section("content")
<table class="table table-hover">
    <thead>
        <tr>
            <th>Transaction ID</th>
            <th>Barcode</th>
            <th></th>
        </tr>
    <thead>
    <tbody
        @foreach ($items as $item)
        <tr> 
            <td> {{ $item['transaction_id'] }} </td>
            <td> {{ $item['barcode'] }} </td>
            <td>
                @if(Auth::user()->role == 'admin')
                {{ Form::open(['url' => 'itemcategories/' . $item['id'], 'style' => 'float: left;']) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('remove', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
                &nbsp;
                <!--<a class="btn btn-small btn-success" href="{{ URL::route('itemcategories.edit',$item['barcode']) }} ">edit</a>-->
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a class="btn btn-small btn-primary" href="{{ URL::route('itemcategories.create') }}">add category</a>
@stop