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
                <a class="navbar-brand" href="{{ url('/') }}"><img src='/image/poss_logo.png'></a>
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

                    @if(Auth::check() && Auth::user()->role != 'clerk')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>{{ HTML::link('/report/sales', 'Sales Report') }}</li>
                            <li>{{ HTML::link('/report/clerkperformance', 'Clerk Performance Report') }}</li>
                            <li>{{ HTML::link('/report/product', 'Product Sales') }}</li>
                        </ul>
                    </li>
                    @endif

                    <li><span style="display:block;width: 100px; height:30px;margin: 10px 0px 3px 3px;">@include('smartsearch')</span></li>

                    @endif
                </ul>   
                <ul class="nav navbar-nav navbar-right">

                    @if(Auth::check())
                    <li><span style="display:block;margin: 10px 0px 3px 3px;width: 23px;"><img src='/image/meow.jpg' class="img-circle" width='30px' height='30px' padding-top='20px' /></span>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->username }}<b class="caret"></b>

                            <!--<li>{{ HTML::linkRoute('profile', 'USERNAME HERE') }}</li> -->

                            <ul class="dropdown-menu">
                                <li>{{ HTML::linkRoute('logout', 'Logout') }}
									{{Session::forget('cashier_number')}}
                                </li>
                            </ul>
                    </li>
                    @endif
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</nav>
@show
