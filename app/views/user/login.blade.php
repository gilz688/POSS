@extends("layout")
@section("content")
	{{HTML::style('css/login.css')}}
	<div class="login_form">
		{{ Form::open([
        	"route"        => "user/login",
        	"autocomplete" => "off"
    		]) }}

	    	<h1><span class="log-in">LOG IN</span></h1>
	    	<p class="float">
		        {{ Form::text("username", Input::get("username"), array('placeholder'=>'Username'), []) }}
		        <i class="icon"></i>
	    	</p>
	    	
	    	<p class="float">
		        {{ Form::password("password", array('placeholder'=>'Password'), []) }}
	    	</p>

	    	@if ($error = $errors->first("password"))
	            <div class="error">
	                {{ $error }}
	            </div>
	        @endif

	        {{ Form::submit("Login",["class"=>"dbutton"]) }}

	    {{ Form::close() }}

	</div>

@stop