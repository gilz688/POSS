@extends("layout")
@section("content")

{{ Form::open([
        "url"        => "purchaseditems",
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}
<fieldset>

<!-- Form Name -->
<legend>Add New Purchase Item</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barcode">Barcode</label>  
  <div class="col-md-4">
  <input id="barcode" name="barcode" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="quantity">Quantity</label>  
  <div class="col-md-4">
  <input id="quantity" name="quantity" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="transaction_id">Transaction ID</label>  
  <div class="col-md-4">
  <input id="transaction_id" name="transaction_id" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>




<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="add"></label>
  <div class="col-md-4">
    <button id="add" name="add" class="btn btn-primary">Add</button>
  </div>
</div>

</fieldset>

{{ Form::close() }}

@stop