@extends("layout")
@section("content")

{{ Form::open([
        "url"        => "items",
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}
<fieldset>

<!-- Form Name -->
<legend>Add New Item</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barcode">Barcode</label>  
  <div class="col-md-4">
  <input id="barcode" name="barcode" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="itemName">Item Name</label>  
  <div class="col-md-4">
  <input id="itemName" name="itemName" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="price">Item Price</label>  
  <div class="col-md-4">
  <input id="price" name="price" type="text" placeholder="" class="form-control input-md" required="">
    
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
  <label class="col-md-4 control-label" for="itemDescription">Description</label>  
  <div class="col-md-6">
  <input id="itemDescription" name="itemDescription" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="label">Label</label>  
  <div class="col-md-4">
  <input id="label" name="label" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="category_id">Category ID</label>  
  <div class="col-md-4">
  <input id="category_id" name="category_id" type="text" placeholder="" class="form-control input-md" required="">
    
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