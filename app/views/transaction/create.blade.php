@extends("layout")
@section("content")
<legend>New Transaction</legend>
<div class="row">
	
	<div class="col-md-4 ">
		<div id="error">
            
		</div>

		
		<div class="form-group">
			<label class="col-md-4 control-label" for="cashier_number">Cashier</label>  
			<div class="col-md-8">
				<input id="cashier_number" name="cashier_number" type="text"  placeholder="Enter cashier number" class="form-control input-md" required="true"/>
			</div>
		</div>
		
		
		<div class="form-group">
			 
			<label class="col-md-4 control-label" for="barcode">Barcode</label>  
			<div class="col-md-8">
				<input id="barcode" name="barcode"  placeholder="" class="form-control input-md" />
			</div>
		</div>
	
		<div class="form-group">
			<label class="col-md-4 control-label" for="barcode">Quantity</label>  
			<div class="col-md-8">
				<input id="quantity" name="quantity" placeholder="" class="form-control input-md" >
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="add"></label>
			<div class="col-md-8">
				<button id="add" name="add" class="btn btn-danger">Add Item</button>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-4 control-label" for="payment">Payment</label>  
			<div class="col-md-8">
				<input id="payment" name="quantity" placeholder="" class="form-control input-md" >
			</div>
		</div>
		
		
		<div class="form-group">
			<label class="col-md-4 control-label" for="done"></label>
			<div class="col-md-8">
				<button id="done" name="done" class="btn btn-danger">Done</button>
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
					<th id="total"></th>
				</tr>
				<tr>
					<th>Received Amount:</th>
					<th></th>
					<th></th>
					<th id="received"></th>
				</tr>
				<tr>
					<th>Change:</th>
					<th></th>
					<th></th>
					<th id="change"></th>
				</tr>
		</tbody>
		</table>
	</div>

	
	
	
			
			
		
	
</div>
<script src="../script/create_transaction.js"></script>

@stop
