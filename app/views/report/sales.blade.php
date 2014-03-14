@extends("layout")
@section("content")
<table class="table table-hover">
    <thead>
        <tr>
            <th>Date</th>
            <th>Hour</th>
            <th>Sales</th>
        </tr>
    <thead>
    <tbody
        @foreach ($rows as $row)
        <tr> 
            <td> {{ $row['date'] }} </td>
            <td> {{ $row['hour'] }} </td>
            <td> {{ $row['sales'] }} </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop