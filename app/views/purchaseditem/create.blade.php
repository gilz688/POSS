@extends("layout")
@section("content")

{{ Form::open([
        "url" => "purchaseditems",
        "autocomplete" => "off",
        "class"        => "form-horizontal"
        
]) }}

<fieldset>
<!-- Form Name -->
<legend>Add New Purchase Item</legend>

<div class="form-group">
  <label class="col-md-4 control-label" for="barcode">Barcode</label>  
  <div class="col-md-4">
  <input id="barcode" name="barcode" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="barcode">Quantity</label>  
  <div class="col-md-4">
  <input id="quantity" name="quantity" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

{{Form::hidden('id',$id)}}

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="add"></label>
  <div class="col-md-4">
    <button id="add" name="add" class="btn btn-primary">Add</button>
  </div>

<!--{{Form::submit('add')}}-->

</fieldset>
<a class="btn btn-small btn-info" href="{{ URL::route('transactions.show',$id) }} ">view invoice</a>
{{ Form::close() }}

@stop
