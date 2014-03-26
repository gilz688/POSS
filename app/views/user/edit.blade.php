@extends("layout")
@section("content")

{{ Form::open([
        'route' => ['users.update', $id],
        'method' => 'PUT',
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}

<div class="col-md-6 col-md-offset-3">
<div style="background: rgba(255,255,255, 0.3); padding: 5px 20px 10px 20px">
<fieldset>

    <!-- Form Name -->
    <legend><span style="font-family:sans-serif:  font-size:10px; text-transform:uppercase;">Edit Existing User</span></legend>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="username"><span style="font-family:sans-serif; font-size:13px ">Username</span></label>  
        <div class="col-md-8">
            <input id="username" name="username" type="text" placeholder="" value="{{ $username }}" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Password input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="password"><span style="font-family:sans-serif; font-size:13px ">New Password</span></label>
        <div class="col-md-8">
            <input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Password input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="confirm"><span style="font-family:sans-serif; font-size:13px ">Confirm New Password</span></label>
        <div class="col-md-8">
            <input id="confirm" name="confirm" type="password" placeholder="" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="role"><span style="font-family:sans-serif; font-size:13px ">Role</span></label>
        <div class="col-md-8">
            <select id="role" name="role" class="form-control">
                <option value="admin" @if($role=='admin') selected="true" @endif>Admin</option>
                <option value="auditor" @if($role=='auditor') selected="true" @endif>Auditor</option>
                <option value="clerk" @if($role=='clerk') selected="true" @endif>Clerk</option>
            </select>
        </div>
    </div>

    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="update"></label>
        <div class="col-md-4">
			<button id="edit" name="update" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i>   UPDATE</button>
				<a  class="btn btn-small btn-danger" href="{{ URL::route('users.index') }}" id="cancel"><i class="glyphicon glyphicon-remove"></i>    CANCEL</a>
        </div>
    </div>

</fieldset>
</div>
</div>
{{ Form::close() }}

@stop