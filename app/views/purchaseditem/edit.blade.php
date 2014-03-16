@extends("layout")
@section("content")

{{ Form::open([
        'route' => ['purchaseditems.update', $barcode],
        'method' => 'PUT',
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}
<fieldset>

<!-- Form Name -->
<legend>Edit Item</legend>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="quantity">Quantity</label>  
  <div class="col-md-4">
  <input id="quantity" name="quantity" type="text" placeholder="" value="{{ $quantity }}"  class="form-control input-md" required="">
    
  </div>
</div>







<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="update"></label>
  <div class="col-md-4">
    <button id="update" name="update" class="btn btn-primary">Edit</button>
  </div>
</div>

</fieldset>

{{ Form::close() }}
@stop