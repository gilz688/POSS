@extends("layout")
@section("content")

<a class="btn btn-small btn-danger" href="{{ URL::route('users.create') }}"><i class="glyphicon glyphicon-user"></i>  ADD USER</a>
<br>
<br>

<div class="loader"></div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Username</th>
            <th>Role</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Middlename</th>
            <th></th>
        </tr>
    </thead>
    <tbody
        @foreach ($users as $user)
        <tr> 
            <td> {{ $user->username }} </td>
            <td> {{ $user->role }} </td>
            <td> {{ $user->lastname }} </td>
            <td> {{ $user->firstname }} </td>
            <td> {{ $user->middlename }} </td>
            <td>
                @if(Auth::user()->role == 'admin' && Auth::user()->username != $user->username)
                {{ Form::open(['url' => 'users/' . $user['id'], 'style' => 'float: left;']) }}
                {{ Form::hidden('_method', 'DELETE') }}
                <form method="POST" action="http://localhost:8000/user/index" accept-charset="UTF-8" style="display:inline">
                    <button class="btn btn-small btn-danger" type="submit" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Item" data-message="Are you sure you want to delete this item ?">
                        <i class="glyphicon glyphicon-trash"></i>  DELETE
                    </button>
                </form>
                {{ Form::close() }}
                &nbsp;
                <a class="btn btn-small btn-success" href="{{ URL::route('users.edit',$user->id) }} "><i class="glyphicon glyphicon-edit"></i>  EDIT</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination">
{{ $users->links() }}
</div>

@stop