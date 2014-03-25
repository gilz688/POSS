@extends("layout")
@section("content")

{{ Form::open([
        "url"        => "itemcategories",
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}

<div class="col-md-6 col-md-offset-3">
<div style="background: rgba(255,255,255,0.2); padding: 5px 20px 10px 20px">
<fieldset>

<!-- Form Name -->
<legend><span style="font-family:sans-serif:  font-size:10px; text-transform:uppercase;">Add New Item Category</span></legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name"><span style="font-family:sans-serif; font-size:13px ">Category Name</span></label>  
  <div class="col-md-8">
  <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="description"><span style="font-family:sans-serif; font-size:13px ">Description</span></label>  
  <div class="col-md-8">
  <input id="description" name="description" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-10 control-label" for="add"></label>
  <div class="col-md-2">
    <button id="add" name="add" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>     ADD</button>
					 <a  class="btn btn-small btn-danger" href="{{ URL::route('itemcategories.index') }}" id="cancel"><i class="glyphicon glyphicon-remove"></i>    CANCEL</a>

 </div>
</div>

</fieldset>

{{ Form::close() }}
</div>
</div>
@stop