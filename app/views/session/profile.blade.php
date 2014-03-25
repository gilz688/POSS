@extends("layout")
@section("content")

{{HTML::style('css/profile.css')}}

<script>

  	$(function() {
    $( "#grapharea" ).sortable();
    $( "#grapharea" ).disableSelection();
  	});

 </script>

<div class="row">

	<div class="col-md-1">
    	<img src="image/meow2.jpg" width= "75px" height="auto"class="img-circle">
	</div>

	<div class="col-md-6">
		<span style="font-weight: bold; font-size: 24px;">Welcome {{ Auth::user()->firstname }}! </span>
		<br>
		<i class="glyphicon glyphicon-user"></i>       <span style="text-transform:uppercase;">{{ Auth::user()->role }}
	</div>

</div>

<br>

<div id="grapharea">

  <holder class="ui-state-default"><img src="image/1.png" width="350px" height="auto" /></holder>
  <holder class="ui-state-default"><img src="image/2.png" width="350px" height="auto"/></holder>
  <holder class="ui-state-default"><img src="image/3.png" width="350px" height="auto"/></holder>

</div>

@stop