@extends("layout")
@section("content")
<div class="login-form">
    {{ Form::open([
        "route"        => "user/login",
        "autocomplete" => "off"
    ]) }}
        {{ Form::label("username", "Username") }}
        {{ Form::text("username", Input::get("username"), [
            
        ]) }}
        {{ Form::label("password", "Password") }}
        {{ Form::password("password", [
            
        ]) }}
        @if ($error = $errors->first("password"))
            <div class="error">
                {{ $error }}
            </div>
        @endif
        {{ Form::submit("login") }}
    {{ Form::close() }}
</div>
@stop
@section("footer")
    @parent
    <script src="//polyfill.io"></script>
@stop