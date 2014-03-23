@extends("layout")
@section("content")

<a class="btn btn-small btn-danger href="{{ URL::route('itemcategories.create') }}"><i class="glyphicon glyphicon-plus"></i>     ADD CATEGORY</a>
<br>
<br>
<center><div id="loader"></div></center>
<div id="list">

</div>
<script type="text/javascript">var role = "{{ Auth::user()->role }}"</script>
<script src="../script/itemcategory.js"></script>



@include('itemcategory.delete_confirm')

@stop