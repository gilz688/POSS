@if(Auth::user()->id == $id)
<a class="btn btn-small btn-danger" disabled="disabled"><i class="glyphicon glyphicon-trash"></i>DELETE</a>
@else
<a class="btn btn-small btn-danger" onclick="removeUser( {{ $id }} )"><i class="glyphicon glyphicon-trash"></i>DELETE</a>
@endif
&nbsp;
<a class="btn btn-small btn-primary" href="{{ URL::route('users.edit', $id) }}"><i class="glyphicon glyphicon-edit"></i>EDIT</a>
