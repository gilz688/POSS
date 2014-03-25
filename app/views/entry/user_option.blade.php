<!--<a class="btn btn-small btn-danger" onclick="removeUser( {{ $id }} )">remove</a> -->
<form method="POST" action="http://localhost:8000/users/index" accept-charset="UTF-8" style="display:inline">
	<button class="btn btn-small btn-danger" onClick="return false;" type="submit"  data-toggle="modal" data-target="#confirmDelete"><!-- data-title="Delete Item" data-message="Are you sure you want to delete this item ?"-->
		<i class="glyphicon glyphicon-trash"></i> DELETE
	</button>
</form>
&nbsp;
<a class="btn btn-small btn-success" onClick="{{ URL::route('users.edit', $id) }} "><i class="glyphicon glyphicon-edit"></i>  EDIT</a>
