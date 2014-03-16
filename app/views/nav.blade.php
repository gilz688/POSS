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
                        @endif {{ HTML::linkRoute('itemcategories.index', 'Item Categories') }}</li>

                    @if(Request::is('items*')) <li class="active">
                        @else <li>
                        @endif {{ HTML::linkRoute('items.index', 'Items') }}</li> 

                    @if(Auth::user()->role == 'admin')

                    @if(Request::is('users*')) <li class="active">
                        @else <li>
                        @endif {{ HTML::linkRoute('users.index', 'Users') }}</li> 
                    @endif

                    @if(Request::is('transactions*')) 
                    <li class="active">
                        @else <li>

                        @endif {{ HTML::linkRoute('transactions.index', 'Transactions') }}</li>     

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>{{ HTML::link('/report/sales', 'Sales Report') }}</li>
                            <li>{{ HTML::link('/report/clerkperformance', 'Clerk Performance Report') }}</li>
                        </ul>
                    </li>

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
