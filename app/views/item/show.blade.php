@extends("layout")
@section("content")
<script type="text/javascript" src="../script/jquery-ean13.min.js"></script>

<div class="col-md-6 col-md-offset-3">
<table class="table table-hover">
    <tbody
        <tr> 
			<td> Barcode: </td>
            <td>
                <canvas id="ean" width="200" height="100">
                    {{ $item['barcode'] }}
                </canvas>
                <script type="text/javascript">
                    $("#ean").EAN13("{{ $item['barcode'] }}");
                </script>
            </td>
        </tr>
        <tr> 
            <td> Item Name: </td>
            <td> {{ $item['itemName'] }} </td>
        </tr>
        <tr> 
            <td> Description: </td>
            <td> {{ $item['itemDescription'] }} </td>
        </tr>
        <tr> 
            <td> Category </td>
            <td> {{ $item['itemcategory']['name'] }} </td>
        </tr>
        <tr> 
            <td> Price: </td>
            <td> {{ 'Php' . $item['price'] }} </td>
        </tr>
        <tr> 
            <td> Quantity: </td>
            <td> {{ $item['quantity'] }} </td>
        </tr>
        <tr> 
            <td> Label: </td>
            <td> {{ $item['label'] }} </td>
        </tr>
    </tbody>
</table>
@stop
</div>