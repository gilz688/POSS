@extends("layout")
@section("content")

<link href="../toastr/toastr.css" rel="stylesheet"/>

    @if(Auth::user()->role=="clerk")
        <a id="transactionView" class="btn btn-small btn-danger" href="{{ URL::route('transactions.create') }} "><i class="glyphicon glyphicon-plus"></i>CREATE TRANSACTION</a>
    @endif

<br>
<br>

<div id="transactionAjaxView"></div>

@include('transaction.delete_confirm')
<div class="loader text-center">@include('loader.preloader_canvas')</div>
	<div id="list"></div>
</div>

<script src="../toastr/toastr.min.js"></script>
<script src="../script/transactions.js"></script>




@stop

