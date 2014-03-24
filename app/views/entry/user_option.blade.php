{{ Form::open(['url' => 'users/' . $id, 'style' => 'float: left;']) }}
{{ Form::hidden('_method', 'DELETE') }}
{{ Form::submit('remove', ['class' => 'btn btn-danger']) }}
{{ Form::close() }}
&nbsp;
               
<a class="btn btn-small btn-success" href="{{ URL::route('users.edit',$id) }} ">edit</a> 