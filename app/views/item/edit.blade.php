@extends("layout")
@section("content")

{{ Form::open([
        'route' => ['items.update', $barcode],
        'method' => 'PUT',
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}

<div class="col-md-6 col-md-offset-3">
<div style="background: #FFFFFF; padding: 5px 20px 10px 20px">
<fieldset>

    <!-- Form Name -->
    <legend><span style="font-family:sans-serif:  font-size:10px; text-transform:uppercase;">Edit Item</span></legend>
    
    <!-- Uneditable barcode -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="barcode"><span style="font-family:sans-serif; font-size:13px ">Barcode</span></label>
        <div class="col-md-8">
            
            <canvas id="ean" width="200" height="100">
                {{ $barcode }}
            </canvas>
            <script type="text/javascript" src="{{ URL::to('/') }}/script/jquery-ean13.min.js"></script>
            <script type="text/javascript">
                $("#ean").EAN13("{{ $barcode }}");
            </script>
        </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="itemName"><span style="font-family:sans-serif; font-size:13px ">Item Name</span></label>  
        <div class="col-md-8">
            <input id="itemName" name="itemName" type="text" placeholder="" value="{{ $itemName }}" class="form-control input-md" required="">

        </div>
    </div>
    
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="price"><span style="font-family:sans-serif; font-size:13px ">Item Price</span></label>  
        <div class="col-md-8">
            <input id="price" name="price" type="text" placeholder="" value="{{ $price }}" class="form-control input-md" required="">

        </div>
    </div>
    
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="quantity"><span style="font-family:sans-serif; font-size:13px ">Quantity</span></label>  
        <div class="col-md-8">
            <input id="quantity" name="quantity" type="text" placeholder="" value="{{ $quantity }}" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="itemDescription"><span style="font-family:sans-serif; font-size:13px ">Description</span></label>  
        <div class="col-md-8">
            <input id="itemDescription" name="itemDescription" type="text" placeholder="" value="{{ $itemDescription }} "class="form-control input-md" required="">

        </div>
    </div>
    
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="label"><span style="font-family:sans-serif; font-size:13px ">Label</span></label>  
        <div class="col-md-8">
            <input id="label" name="label" type="text" placeholder="" value="{{ $label }} "class="form-control input-md" required="">

        </div>
    </div>
   
    	<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="category_id">Category</label>  
  <div class="col-md-4">
  <select name="category_id" id="category_id" value="{{ $category_id }}">
					<option value="">{{ $itemcategory['name']}}</option>
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
				</select>    
  </div>
</div>
    
    <!-- Button -->
    <div class="form-group">
        <label class="col-md-9 control-label" for="update"></label>
        <div class="col-md-3">
            <button id="edit" name="update" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i>   UPDATE</button>
			 <a href="{{ URL::route('items.index') }}" class="btn btn-large">Cancel</a>
		</div>
    </div>
    
</fieldset>

{{ Form::close() }}
</div>
</div>
@stop