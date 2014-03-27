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
	<thead><tr><th>Name</th><th>Amount</th></tr></thead>
	<tbody>
		@foreach($amountAndName as $value)
		<tr><td>{{$value['name']}}</td><td>{{$value['amount']}}</td></tr>
		
		@endforeach
		<tr><th>Total:</th><th> {{ $transaction['sales'] }}</th></tr>
		
		
	</tbody>
</table>
</div>


<div class="col-md-6">
<table class="table table-hover">
    <thead>
        <tr>
           
            <th>Quantity</th>
        </tr>
        
    <thead>
    <tbody>
        @foreach($items as $item)
        <tr> 
           
            <td> {{ $item['quantity'] }} </td>
         </tr>  

            @endforeach
        
    </tbody>
</table>
</div>

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

