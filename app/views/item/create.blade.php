@extends("layout")
@section("content")

{{ Form::open([
        "url"        => "items",
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}

<div class="col-md-6 col-md-offset-3">
<div style="background: rgba(255,255,255, 0.3); padding: 5px 20px 10px 20px">
<fieldset>

<!-- Form Name -->
<legend>Add New Item</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barcode">Barcode</label>  
  <div class="col-md-6">
  <input id="barcode" name="barcode" type="text" placeholder="" class="form-control input-md" required="" >
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="itemName">Item Name</label>  
  <div class="col-md-6">
  <input id="itemName" name="itemName" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="price">Item Price</label>  
  <div class="col-md-6">
  <input id="price" name="price" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="quantity">Quantity</label>  
  <div class="col-md-6">
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
  <div class="col-md-6">
  <input id="label" name="label" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Tselect input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="category_id">Category ID</label>  
  <div class="col-md-6">
	  <select id="category_id" name="category_id">
			<option value="">--select--</option>
			<option value="1">Baby Items</option>
			<option value="2">Baking</option>
			<option value="3">Beverages</option>
			<option value="4">Bread/Bakery</option>
			<option value="5">Canned Goods</option>
			<option value="6">Cereal/Breakfast</option>
			<option value="7">Condiments</option>
			<option value="8">Dairy</option>
			<option value="9">Frozen Foods</option>
			<option value="10">Health & Beauty</option>
			<option value="11">Kitchen Utensils</option>
		</select>
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="add"></label>
  <div class="col-md-4">
  <div class="row">
    <button id="add" name="add" class="btn btn-md btn-primary"><i class="glyphicon glyphicon-plus-sign">ADD</i></button>
			 <a  class="btn btn-md btn-danger" href="{{ URL::route('items.index') }}" id="cancel"><i class="glyphicon glyphicon-remove"></i>CANCEL</a></div>
  </div>
</div>

</fieldset>

{{ Form::close() }}
	</div>
</div>

@stop
