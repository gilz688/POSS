@extends("layout")
@section("content")

    @if(Auth::user()->role=="clerk")
        <a class="btn btn-small btn-danger" href="{{ URL::route('transactions.create') }}"><i class="glyphicon glyphicon-plus"></i>CREATE TRANSACTION</a>
    @endif

<br>
<br>

<div class="loader text-center">@include('loader.preloader_canvas')</div>
<div id="list">
</div>

</div>

<script src="../script/transactions.js"></script>

@stop