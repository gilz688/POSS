@section("nav")
<nav>
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Point of Sales System</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    @if(Auth::check())
                    @if(Request::is('itemcategories*')) <li class="active">
                        @else <li>
                        @endif <a href="/itemcategories">Item Categories</a></li>

                    @if(Request::is('items*')) <li class="active">
                        @else <li>
                        @endif <a href="/items">Items</a></li> 

                    @if(Auth::user()->role == 'admin')

                    @if(Request::is('users*')) <li class="active">
                        @else <li>
                        @endif <a href="/users">Users</a></li> 
                    @endif

                    @if(Request::is('transactions*')) 
                    <li class="active">
                        @else <li>
                        @endif <a href="/transactions">Transactions</a></li>     
                    @endif
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                    <li>
                        {{ HTML::linkRoute('profile', 'Profile') }}</li>
                    <li>{{ HTML::linkRoute('logout', 'Logout') }}</li>
                    @endif
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</nav>
@show