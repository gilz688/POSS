@extends("layout")
@section("content")
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
    <thead>
    <tbody
        @foreach ($users as $user)
        <tr> 
            <td> {{ $user['username'] }} </td>
            <td> {{ $user['role'] }} </td>
            <td> {{ $user['lastname'] }} </td>
            <td> {{ $user['firstname'] }} </td>
            <td> {{ $user['middlename'] }} </td>
            <td>
                @if(Auth::user()->role == 'admin' && Auth::user()->username != $user['username'])
                {{ Form::open(['url' => 'users/' . $user['id'], 'style' => 'float: left;']) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('remove', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
                &nbsp;
                <a class="btn btn-small btn-success" href="{{ URL::route('users.edit',$user['id']) }} ">edit</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a class="btn btn-small btn-primary" href="{{ URL::route('users.create') }}">add user</a>
@stop