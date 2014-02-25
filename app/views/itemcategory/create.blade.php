@extends("layout")
@section("content")

{{ Form::open([
        "url"        => "itemcategories",
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}
<fieldset>

<!-- Form Name -->
<legend>Add New Item Category</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">Category Name</label>  
  <div class="col-md-4">
  <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="description">Description</label>  
  <div class="col-md-6">
  <input id="description" name="description" type="text" placeholder="" class="form-control input-md" required="">
    
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