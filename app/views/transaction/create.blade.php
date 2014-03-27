@extends("layout")
@section("content")
<legend>New Transaction</legend>
<div class="row">

	<div class="col-md-4 ">
		@if ($error != null)
            <div id="login-alert" class="alert alert-danger col-sm-12"> 
                {{ $error }}
            </div>
            @endif

		
		<div class="form-group">
			<label class="col-md-4 control-label" for="cashier_number">Cashier</label>  
			<div class="col-md-8">
				<input id="cashier_number" name="barcode" type="number"  placeholder="Enter cashier number" class="form-control input-md" required="true"/>
			</div>
		</div>
		
		
		<div class="form-group">
			 
			<label class="col-md-4 control-label" for="barcode">Barcode</label>  
			<div class="col-md-8">
				<input id="barcode" name="barcode" type="text" placeholder="" class="form-control input-md" required=""/>
			</div>
		</div>
	
		<div class="form-group">
			<label class="col-md-4 control-label" for="barcode">Quantity</label>  
			<div class="col-md-8">
				<input id="quantity" name="quantity" type="number" placeholder="" class="form-control input-md" required="">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="add"></label>
			<div class="col-md-8">
				<button id="add" name="add" class="btn btn-danger">Add Item</button>
			</div>
		</div>
		

		
	</div>
	
	
	<div class="col-md-8">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody  id="top">
				
				
			</tbody>
				
		</table>
		<table class="table table-hover">
		<thead></thead>
		<tbody>	
				<tr>
					<th>Total:</th>
					<th></th>
					<th></th>
					<th>123.00</th>
				</tr>
				<tr>
					<th>Received Amount:</th>
					<th></th>
					<th></th>
					<th>123.00</th>
				</tr>
				<tr>
					<th>Change:</th>
					<th></th>
					<th></th>
					<th>123.00</th>
				</tr>
		</tbody>
		</table>
	</div>
	
	
	
	
</div>
<script src="../script/create_transaction.js"></script>

@stop
