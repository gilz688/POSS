@extends("layout")
@section("content")

    @if(Auth::user()->role=="clerk")

        <a id="transactionView" class="btn btn-small btn-danger" href="{{ URL::route('transactions.create') }} "><i class="glyphicon glyphicon-plus"></i>CREATE TRANSACTION</a>

    @endif

<br>
<br>


<div id="transactionAjaxView"></div>

<div class="loader text-center">@include('loader.preloader_canvas')</div>
	<div id="list"></div>
</div>

<script type="text/javascript">
	('#transactionView').click(function(){
		$.ajax({
			url: siteloc + '/transaction',
			success: function(data){
				$('#transactionAjaxView').html(data);
			}
			
		});
		
		
	});
</script>

@stop

