@if(Auth::user()->role != 'clerk')
<a class="btn btn-small btn-danger" onclick="removeItem( {{ $barcode }} )"><i class="glyphicon glyphicon-trash"></i>DELETE</a>
&nbsp;
               
<a class="btn btn-small btn-primary" href="{{ URL::route('items.edit', $barcode) }}"><i class="glyphicon glyphicon-edit"></i>EDIT</a>
@endif