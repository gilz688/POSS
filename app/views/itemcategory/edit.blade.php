@extends("layout")
@section("content")

{{ Form::open([
        'route' => ['itemcategories.update', $id],
        'method' => 'PUT',
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}
<fieldset>

    <!-- Form Name -->
    <legend>Edit Existing Item Category</legend>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="name">Category Name</label>  
        <div class="col-md-4">
            <input id="name" name="name" type="text" placeholder="" value="{{ $name }}" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="description">Description</label>  
        <div class="col-md-6">
            <input id="description" name="description" type="text" placeholder="" value="{{ $description }} "class="form-control input-md" required="">

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