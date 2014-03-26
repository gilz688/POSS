@extends("layout")
@section("content")
<div class="row">
	<!--<div class="col-md-4">
		<table class="table table-hover">
		<thead>
			<tr>
				<th>Received</th>
				<th>Total</th>
				
				<th>Change</th>
			</tr><thead>
		<tbody>
			<td><input type="text" class="form-control" id="receivedAmount"></td>
			<td>{{ $transaction['sales'] }}</td>
			<td id="change"></td>
				
		</tbody>
		</table>

		
	</div> -->
	
<div class="col-md-4">
<table class="table table-hover">
    <thead>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
             @if(Auth::user()->role == 'auditor')
				<th>Action</th>
            @endif
        </tr>
        
    <thead>
    <tbody>
        @foreach($items as $item)
        <tr> 
            <td> {{ $item['barcode'] }} </td>
            <td> {{ $item['quantity'] }} </td>
         </tr>  

            @endforeach
        
    </tbody>
</table>
</div>

<div class="col-md-4">
<table class="table table-hover">
	<thead><tr><th>Amount</th></tr></thead>
	<tbody>
		@foreach($amount as $value)
		<tr><td>{{$value}}</td></tr>
		@endforeach
		<tr><th>Total: {{ $transaction['sales'] }}</th></tr>
		
		
	</tbody>
</table>
</div

</div>

<script type="text/javascript">
$('#receivedAmount').keypress(function(e){
	if(e.which == 13){
		var receivedAmount = parseInt($('#receivedAmount').val());
		var totalSales = {{$transaction['sales']}};
		var change = receivedAmount - totalSales;
		
		$("#change").html(change.toString());
	}
	
	
});

</script>


@stop

