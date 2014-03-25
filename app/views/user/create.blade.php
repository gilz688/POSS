@extends("layout")
@section("content")

{{ Form::open([
        "url"        => "users",
        "autocomplete" => "off",
        "class" => "form-horizontal"
    ]) }}

<div class="col-md-6 col-md-offset-3">
<div style="background: rgba(255,255,255, 0.3); padding: 5px 20px 10px 20px">

<fieldset>

    <!-- Form Name -->
    <legend><span style="font-family:sans-serif:  font-size:10px; text-transform:uppercase;">Add New User</span></legend>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="username"><span style="font-family:sans-serif; font-size:13px ">Username</span></label>  
        <div class="col-md-8">
            <input id="username" name="username" type="text" placeholder="" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Password input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="password"><span style="font-family:sans-serif; font-size:13px ">Password</span></label>
        <div class="col-md-8">
            <input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Password input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="confirm"><span style="font-family:sans-serif; font-size:13px ">Confirm Password</span></label>
        <div class="col-md-8">
            <input id="confirm" name="confirm" type="password" placeholder="" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="role"><span style="font-family:sans-serif; font-size:13px ">Role</span></label>
        <div class="col-md-8">
            <select id="role" name="role" class="form-control" default="">
                <option value="admin">Admin</option>
                <option value="auditor">Auditor</option>
                <option value="clerk" selected="selected">Clerk</option>
            </select>
        </div>
    </div>

    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="add"></label>
        <div class="col-md-4">
            <button id="add" name="add" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>     ADD</button>
								<a  class="btn btn-small btn-danger" href="{{ URL::route('users.index') }}" id="cancel"><i class="glyphicon glyphicon-remove"></i>    CANCEL</a>

		</div>
    </div>

</fieldset>

{{ Form::close() }}
</div>
</div>
@stop