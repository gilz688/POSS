@extends("layout")
@section("content")
<table class="table table-hover">
    <thead>
        <tr>
            <th>Hour</th>
            <th>Transactions</th>
            <th>Number</th>
            <th>Sales</th>
        </tr>
    <thead>
    <tbody
        @foreach($rows as $row)
        <tr> 
            <td> {{ $row['hour'] }} </td>
            <td> {{ $row['transactions'] }} </td>
            <td> {{ $row['number'] }} </td>
            <td> {{ $row['sales'] }} </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop