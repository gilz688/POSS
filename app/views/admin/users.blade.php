@extends("layout")
@section("content")
<div class="user"></div>
    <table class="users_table">
        <tr>
            <th>username</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        
        @foreach ($users as $user)
        <tr> 
            <td> {{ $user->username }} </td>
            <td> {{ $user->role }} </td>
            <td>
                @if ($user->username != $username)
                    <a href="{{ route('users/remove', [ 'userId' => $user->id ]) }}">remove</a> 
                @endif
            </td>
        </tr>
        @endforeach

    </table>
    <a href="{{ URL::to('users/add') }}" class="button">Add New User</a>
</div>
@stop