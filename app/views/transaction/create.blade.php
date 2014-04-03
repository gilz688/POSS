@extends("layout")
@section("content")

<link rel="stylesheet" type="text/css" href="../css/transaction.css"/>
<link href="../toastr/toastr.css" rel="stylesheet"/>
<script src="../toastr/toastr.min.js"></script>

<div class="row">
	<div class="col-md-4">
		<div id="error">
            
		</div>

		<div class="form-group">	 
			<label class="col-md-4 control-label" for="barcode">Barcode</label>  
			<div class="col-md-8" style="padding-bottom: 10px">
				<input id="barcode" name="barcode"  placeholder="" class="form-control input-md" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="barcode">Quantity</label>  
			<div class="col-md-8" style="padding-bottom: 10px">
				<input id="quantity" name="quantity" placeholder="" class="form-control input-md" >
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="add"></label>
			<div class="col-md-8 text-center" style="padding-bottom: 50px">
				<button id="add" name="add" class="btn btn-danger">Add Item</button>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="payment">Payment</label>  
			<div class="col-md-8" style="padding-bottom: 10px">
				<input id="payment" name="payment" placeholder="" class="form-control input-md" >
			</div>
		</div>
		
		
		<div class="form-group">
			<label class="col-md-4 control-label" for="done"></label>
			<div class="col-md-8 text-center">
				<button id="done" name="done" class="btn btn-danger">Done</button>
				 <button id="new" name="new" class="btn btn-danger">New Transaction</button>
			</div>
		</div>
	</div>
	<div class="col-md-8 well well-sm" >
 		<div id="items">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Item</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Amount</th>
					<th>Option</th>
				</tr>
			</thead>
				<tbody id="top"></tbody>
		</table>
		</div>

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
