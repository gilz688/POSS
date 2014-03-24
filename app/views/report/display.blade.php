@extends("layout")
@section("content")
<table class="table table-hover">
    <thead>
        <tr>
            <th>Clerk Name</th>
            <th></th>
        </tr>
    <thead>
    <tbody>
        @foreach ($users as $user)
        <tr> 
            <td> {{ HTML::link('/report/clerk/'.$user['id'] , $user['firstname']." ".$user['middlename']." ".$user['lastname'] )}}  </td>
            <td>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination">
{{ $users->links() }}
</div>

@stop