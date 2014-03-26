@extends("layout")
@section("content")

<script src="../script/users.js"></script>


<link href="../toastr/toastr.css" rel="stylesheet"/></script>

<a class="btn btn-small btn-danger" href="{{ URL::route('users.create') }}"><i class="glyphicon glyphicon-user"></i>  ADD USER</a>
<br>
<br>

<div class="loader text-center">@include('loader.preloader_canvas')</div>
<div id="list">
</div>

<script src="../toastr/toastr.min.js"></script>
<script type="text/javascript">var role = "{{ Auth::user()->role }}"</script>


@include('user.confirm_delete')


@stop
