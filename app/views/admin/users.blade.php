@extends("layout")
@section("content")
<table style="width:300px">
    <tr>
        <th>username</th>
        <th>role</th>
        <th></th>
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
<a href="{{ URL::to('users/add') }}">add user</a>
@stop