@extends("layout")
@section("content")

{{ Form::open([
        "route"        => "users/add",
        "autocomplete" => "off",
        "class" => "form-horizontal"
    ]) }}

<fieldset>

    <!-- Form Name -->
    <legend>Add New User</legend>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="username">Username</label>  
        <div class="col-md-4">
            <input id="username" name="username" type="text" placeholder="" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Password input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="password">Password</label>
        <div class="col-md-4">
            <input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Password input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="confirm">Confirm Password</label>
        <div class="col-md-4">
            <input id="confirm" name="confirm" type="password" placeholder="" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="role">Role</label>
        <div class="col-md-4">
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
            <button id="add" name="add" class="btn btn-primary">Add</button>
        </div>
    </div>

</fieldset>

{{ Form::close() }}
@stop