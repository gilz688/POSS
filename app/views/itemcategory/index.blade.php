@extends("layout")
@section("content")
@if(Auth::user() != null)
	@if(Auth::user()->role == 'admin')
		<a class="btn btn-small btn-danger" href="{{ URL::route('itemcategories.create') }}"><i class="glyphicon glyphicon-plus"></i>     ADD CATEGORY</a>
	@endif
@endif

<br>
<br>

<div class="loader text-center">@include('loader.preloader_canvas')</div>
<div id="list">
</div>


</div>

<script type="text/javascript">var role = "{{ Auth::user()->role }}"</script>
<script src="../script/itemcategory.js"></script>

@include('itemcategory.delete_confirm')

@stop