<form method="POST" action="http://localhost:8000/itemcategories/index" accept-charset="UTF-8" style="display:inline">
	<button class="btn btn-small btn-danger" onClick="return false;" type="submit"  data-toggle="modal" data-target="#confirmDelete">
		<i class="glyphicon glyphicon-trash"></i> DELETE
	</button>
</form>
&nbsp;
<a class="btn btn-small btn-primary" href="{{ URL::route('itemcategories.edit', $id) }}"><i class="glyphicon glyphicon-edit"></i>EDIT</a>
