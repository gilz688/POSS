@extends("layout")
@section("content")

{{HTML::style('./css/login.css')}}

<div id="mainlayout">
<div id="loginbox" class="col-md-4">
</div>
<div class="col-md-4">
    <div class="panel panel-primary" >
       
        <div class="panel-body" >
            @if ($error = $errors->first("password"))
            <div id="login-alert" class="alert alert-danger col-sm-12"> 
                {{ $error }}
            </div>
            @endif

            {{ Form::open(["url"        => "/login",
                    "autocomplete" => "off", 'class'=>'form-horizontal']) }}

            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                {{ Form::text('username', null, ['class'=>'form-control', 'placeholder'=>'Username']) }}
            </div>

            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                {{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) }}
            </div>

            <div class="row">
       
        
            <div class="col-md-4 controls">
                {{ Form::submit('LOGIN', ['class'=>'btn btn-success'])}}
            </div>
            
            
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
</div>

@stop