@extends("layout")
@section("content")

	{{HTML::style('./css/login.css')}}
	@if ($error = $errors->first("password"))
	    <div class="error">
	        {{ $error }}
	    </div>
	@endif
	
	<div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<div class="panel panel-info" >
	        <div class="panel-heading">
                <div class="panel-title">Sign In</div>
            </div> 
        	<div class="panel-body" >

            <div id="login-alert" class="alert alert-danger col-sm-12"></div>
				{{ Form::open(["route"        => "user/login",
        			"autocomplete" => "off", 'class'=>'form-horizontal']) }}
 			
 					<div class="input-group">
 						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    					{{ Form::text('username', null, ['class'=>'form-control', 'placeholder'=>'Username']) }}
    				</div>
    		
    				<div class="input-group">
    					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    					{{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) }}
 					</div>
 			
 					<div class="col-sm-12 controls">
    					{{ Form::submit('Login', ['class'=>'btn btn-success'])}}
    				</div>
    			{{ Form::close() }}
    		</div>
    	</div>
    </div>
	
@stop