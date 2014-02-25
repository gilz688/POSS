@extends("layout")
@section("content")
<table class="table table-hover">
    <thead

        <tr>
            <th>username</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody
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
    </tbody>
</table>
<a href="{{ URL::to('users/add') }}" class="button">Add New User</a>
@stop