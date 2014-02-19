@extends("layout")
@section("content")
<div class="login-form">
    {{ Form::open([
        "route"        => "users/add",
        "autocomplete" => "off"
    ]) }}
    <table style="width:300px">
        <tr>
            <td>
                {{ Form::label("username", "Username") }}
            </td>
            <td>
                {{ Form::text("username", Input::get("username"), []) }}
            </td>
        </tr>
        <tr>
            <td>
                {{ Form::label("password", "Password") }}
            </td>
            <td>
                {{ Form::password("password", []) }}
            </td>
        </tr>
        <tr>
            <td>
                {{ Form::label("confirm", "Confirm Password") }}
            </td>
            <td>
                {{ Form::password("confirm", []) }}
            </td>
        </tr>
        <tr>
            <td>
                {{ Form::label("role", "Role") }}
            </td>
            <td>
            {{ Form::select('role', array('admin' => 'Admin', 'auditor' => 'Auditor', 'clerk' => 'Clerk'), 'clerk') }}
            </td>
        </tr>
    </table>
        @if ($error = $errors->first("password"))
            <div class="error">
                {{ $error }}
            </div>
        @endif
        {{ Form::submit("Add User") }}
    {{ Form::close() }}
</div>
@stop