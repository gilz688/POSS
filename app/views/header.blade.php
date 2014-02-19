@section("header")
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <div class="header">
        <div class="container">
            <h1>Point of Sales System</h1>
            @if (Auth::check())
                <a href="{{ URL::route("user/logout") }}">
                    logout
                </a>
                |
                <a href="{{ URL::route("user/profile") }}">
                    profile
                </a>
                
                @if (Auth::user()->role == 'admin')
                |
                <a href="{{ URL::route("users") }}">
                    users
                </a>
				|
				<a href="{{ URL::route("items") }}">
					Manage Items
				</a>
                @endif
            @else
                <a href="{{ URL::route("user/login") }}">
                    login
                </a>
            @endif
        </div>
    </div>
@show