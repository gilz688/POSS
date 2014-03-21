@extends("layout")
@section("content")

{{ Form::open([
        "url"        => "items",
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}

<div class="col-md-6 col-md-offset-3">
<div style="background: #FFFFFF; padding: 5px 20px 10px 20px">

<fieldset>

<!-- Form Name -->
<legend><span style="font-family:sans-serif:  font-size:10px; text-transform:uppercase;">Add New Item</span></legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barcode"><span style="font-family:sans-serif; font-size:13px ">Barcode</span></label>  
  <div class="col-md-8">
  <input id="barcode" name="barcode" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="itemName"><span style="font-family:sans-serif; font-size:13px ">Item Name</span></label>  
  <div class="col-md-8">
  <input id="itemName" name="itemName" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="price"><span style="font-family:sans-serif; font-size:13px ">Item PriceM</span></label>  
  <div class="col-md-8">
  <input id="price" name="price" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="quantity"><span style="font-family:sans-serif; font-size:13px ">Quantity</span></label>  
  <div class="col-md-8">
  <input id="quantity" name="quantity" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="itemDescription"><span style="font-family:sans-serif; font-size:13px ">Description</span></label>  
  <div class="col-md-8">
  <input id="itemDescription" name="itemDescription" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="label"><span style="font-family:sans-serif; font-size:13px ">Label</span></label>  
  <div class="col-md-8">
  <input id="label" name="label" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="category_id"><span style="font-family:sans-serif; font-size:13px ">Category ID</span></label>  
  <div class="col-md-8">
  <input id="category_id" name="category_id" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-10 control-label" for="add"></label>
  <div class="col-md-2">
    <button id="add" name="add" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>     ADD</button>
  </div>
</div>

</fieldset>

{{ Form::close() }}

</div>
</div>
@stop