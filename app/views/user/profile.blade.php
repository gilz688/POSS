@extends("layout")
@section("content")
	{{HTML::style('css/profile.css')}}
		<div class="pic">
			<img src="image/meow.jpg">
		</div>

    <h2>Hello {{ Auth::user()->username }}!</h2>
    <p>Name:</p>
    <p>Email:</p>
    <p>Role:</p>
    <p>Change password:</p>
@stop