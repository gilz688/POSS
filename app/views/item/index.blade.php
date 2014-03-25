@extends("layout")
@section("content")


<a class="btn btn-small btn-danger" href="{{ URL::route('items.create') }}"><i class="glyphicon glyphicon-plus-sign"></i>  ADD ITEM</a>
<br>
<br>

<div class="loader text-center">@include('loader.preloader_canvas')</div>
 
<div id="list">
</div>


<script type="text/javascript">var role = "{{ Auth::user()->role }}"</script>
<script src="../script/item.js"></script>
@include('item.delete_confirm')

@stop