@extends("layout")
@section("content")

{{ Form::open([
        'route' => ['items.update', $barcode],
        'method' => 'PUT',
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}
<fieldset>

    <!-- Form Name -->
    <legend>Edit Item</legend>
	
	<!-- Uneditable barcode -->
	<div class="form-group">
        <label class="col-md-4 control-label" for="barcode">Barcode</label>
        <div class="col-md-4">
			<input  name="barcode" type="text" placeholder="" value="{{ $barcode }}" onfocus="this.blur()" />
		</div>
	</div>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="itemName">Item Name</label>  
        <div class="col-md-4">
            <input id="itemName" name="itemName" type="text" placeholder="" value="{{ $itemName }}" class="form-control input-md" required="">

        </div>
    </div>
	
	<!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="price">Item Price</label>  
        <div class="col-md-4">
            <input id="price" name="price" type="text" placeholder="" value="{{ $price }}" class="form-control input-md" required="">

        </div>
    </div>
	
	<!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="quantity">Quantity</label>  
        <div class="col-md-4">
            <input id="quantity" name="quantity" type="text" placeholder="" value="{{ $quantity }}" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="itemDescription">Description</label>  
        <div class="col-md-6">
            <input id="itemDescription" name="itemDescription" type="text" placeholder="" value="{{ $itemDescription }} "class="form-control input-md" required="">

        </div>
    </div>
	
	<!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="label">Label</label>  
        <div class="col-md-6">
            <input id="label" name="label" type="text" placeholder="" value="{{ $label }} "class="form-control input-md" required="">

        </div>
    </div>
	
	<!-- Uneditable category_id -->
	<div class="form-group">
        <label class="col-md-4 control-label" for="category_id">Category ID</label>
        <div class="col-md-4">
			<input  name="category_id" type="text" placeholder="" value="{{ $category_id }}" onfocus="this.blur()" />
		</div>
	</div>
	
    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="update"></label>
        <div class="col-md-4">
            <button id="edit" name="update" class="btn btn-primary">update</button>
        </div>
    </div>
	
</fieldset>

{{ Form::close() }}
@stop