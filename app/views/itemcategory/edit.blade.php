@extends("layout")
@section("content")

{{ Form::open([
        'route' => ['itemcategories.update', $id],
        'method' => 'PUT',
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}

 <div class="col-md-6 col-md-offset-3">
 <div style="background: rgba(255,255,255, 0.3); padding: 5px 20px 10px 20px">
<fieldset>

    <!-- Form Name -->
    <legend><span style="font-family:sans-serif:  font-size:10px; text-transform:uppercase;">Edit Existing Item Category</span></legend>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="name"><span style="font-family:sans-serif; font-size:14px ">Category Name</span></label>  
        <div class="col-md-8">
            <input id="name" name="name" type="text" placeholder="" value="{{ $name }}" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="description"><span style="font-family:sans-serif; font-size:14px ">Description</span></label>  
        <div class="col-md-8">
            <input id="description" name="description" type="text" placeholder="" value="{{ $description }} "class="form-control input-md" required="">

        </div>
    </div>

    <!-- Button -->
    <div class="form-group">
        <label class="col-md-11  control-label" for="update"></label>
        <div class="col-md-1 col-md-offset-9">
			<button id="edit" name="update" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i>   UPDATE</button>
			 <a  class="btn btn-small btn-danger" href="{{ URL::route('itemcategories.index') }}" id="cancel"><i class="glyphicon glyphicon-remove"></i>    CANCEL</a>
        </div>
    </div>

</fieldset>

{{ Form::close() }}

</div>
</div>
@stop