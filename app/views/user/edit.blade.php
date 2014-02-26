@extends("layout")
@section("content")

{{ Form::open([
        'route' => ['users.update', $id],
        'method' => 'PUT',
        "autocomplete" => "off",
        "class"        => "form-horizontal"
]) }}
<fieldset>

    <!-- Form Name -->
    <legend>Edit Existing User</legend>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="username">Username</label>  
        <div class="col-md-4">
            <input id="username" name="username" type="text" placeholder="" value="{{ $username }}" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Password input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="password">New Password</label>
        <div class="col-md-4">
            <input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Password input-->
    <div class="form-group">
        <label class="col-md-4 control-label" for="confirm">Confirm New Password</label>
        <div class="col-md-4">
            <input id="confirm" name="confirm" type="password" placeholder="" class="form-control input-md" required="">

        </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="role">Role</label>
        <div class="col-md-4">
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
            <button id="add" name="update" class="btn btn-primary">Update</button>
        </div>
    </div>

</fieldset>

{{ Form::close() }}
@stop