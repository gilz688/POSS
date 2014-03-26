@if(Auth::user()->role == 'auditor')
	<a class="btn btn-small btn-danger" onclick="voidTransaction({{ $id }})">void</a>
@endif
&nbsp;

<a class="btn btn-small btn-info" href="{{ URL::route('transactions.show',$id) }} ">view invoice</a>
