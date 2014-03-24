@extends("layout")
@section("content")
<script type="text/javascript" src="../script/jquery-ean13.min.js"></script>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Item Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr> 
            <td> <span style="font-weight: bold; font-family: sans-serif;">{{ HTML::link('items/' . $item['barcode'], $item['itemName']) }} <span/> </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop