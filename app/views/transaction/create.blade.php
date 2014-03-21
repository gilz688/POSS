@extends("layout")
@section("content")



{{ Form::open([
        "url"        => "transactions",
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}

<form class="form-horizontal">
    <fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cashier_number">Cashier Number</label>  
  <div class="col-md-4">
  <input id="cashier_number" name="cashier_number" type="text" placeholder="" class="form-control input-md" required="">
    
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
