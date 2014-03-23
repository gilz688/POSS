@extends("layout")
@section("content")
<center><div id="loader"></div></center>
<div id="list">

</div>
<script type="text/javascript">var role = "{{ Auth::user()->role }}"</script>
<script src="../script/itemcategory.js"></script>
<a class="btn btn-small btn-primary" href="{{ URL::route('itemcategories.create') }}">add category</a>

<button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>

@include('dialog.delete_confirm')

@stop