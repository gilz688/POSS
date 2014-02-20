@section("header")
    <div class="header">
        <div class="container">
            <h1>Point of Sales System</h1>

            @if (Auth::check())
                <a href="{{ URL::route("user/logout") }}">
                    Logout
                </a>
                <a href="{{ URL::route("user/profile") }}">
                    Profile
                </a>

                @if (Auth::user()->role == 'admin')
                <a href="{{ URL::route("users") }}">
                    Users  
                </a>
                @endif

            @else
                <a href="{{ URL::route("user/login") }}">
                    Login
                </a>
            @endif
        </div>
    </div>
@show