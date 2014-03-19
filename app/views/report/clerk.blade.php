@extends("layout")
@section("content")
<table class="table table-hover">
    <thead>
        <tr>
            <th>Date Created</th>
            <th>Total Transaction</th>
        </tr>
    <thead>
    <tbody>
        @foreach($rows as $row)
        <tr> 
            <td>{{ $row['date'] }}</td>
            <td>Php {{ $row['sales'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop