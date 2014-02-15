@section("header")
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
                @endif
            @else
                <a href="{{ URL::route("user/login") }}">
                    login
                </a>
            @endif
        </div>
    </div>
@show