@if(Auth::user()->role != 'clerk')
<a class="btn btn-small btn-danger" onclick="removeCategory( {{ $id }} )"><i class="glyphicon glyphicon-trash"></i>DELETE</a>
&nbsp; 
               
<a class="btn btn-small btn-primary" href="{{ URL::route('itemcategories.edit', $id) }}"><i class="glyphicon glyphicon-edit"></i>EDIT</a>
@endif

