@extends("layout")
@section("content")

{{ Form::open([
        "url"        => "purchaseditems",
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}
<form class="form-horizontal">
    <fieldset>

        <!-- Text input-->
        <div class="form-group">
            <div class="col-md-4">
                <input id="textinput" name="textinput" type="text" placeholder="Barcode" class="form-control input-md">
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
</form>
{{ Form::close() }}

@stop