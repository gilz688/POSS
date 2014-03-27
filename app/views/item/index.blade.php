@extends("layout")
@section("content")

<link href="../toastr/toastr.css" rel="stylesheet"/>

@if(Auth::user() != null)
	@if(Auth::user()->role == 'admin')
        <a class="btn btn-small btn-danger" href="{{ URL::route('items.create') }}"><i class="glyphicon glyphicon-plus"></i>ADD ITEM</a>
	@endif
<br>

<br>

<div class="loader text-center">@include('loader.preloader_canvas')</div>

<div id="list">
</div>
	
@endif


<script type="text/javascript">var role = "{{ Auth::user()->role }}"</script>
<script src="../script/item.js"></script>
<script src="../toastr/toastr.min.js"></script>
@include('item.delete_confirm')

@stop
