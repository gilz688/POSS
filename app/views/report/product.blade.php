@extends("layout")
@section("content")
<table class="table table-hover" align="right">
    <thead>
        <tr>
            <th>Item Name</th>
            <th>By quantity</th>
        </tr>
    <thead>
    <tbody>
         @foreach($quantities as $quantity => $value)
        <tr> 
            <td> {{ $quantity }}</td>
            <td> {{ $value }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<table class="table table-hover" align="right">
    <thead>
        <tr>
            <th>Item Name</th>
            <th>By sales</th>
        </tr>
    <thead>
    <tbody>
         @foreach($prices as $price => $value)
        <tr> 
            <td> {{ $price }}</td>
            <td>Php {{ $value }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop