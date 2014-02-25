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
                @if(Auth::user()->role == 'admin')
                    <li><a href="/itemcategories">Item Categories</a></li>
                    <li><a href="/items">Items</a></li> 
                    <li><a href="/users">Users</a></li> 
                @endif
                @if(Auth::user()->role == 'clerk')
                    <li><a href="/transactions">Transactions</a></li> 
                @endif
                @if(Auth::user()->role == 'auditor')
                    <li><a href="/transactions">Transactions</a></li> 
                @endif
                
            @endif
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
              <li>
                  <a href="/profile">Profile</a></li>
              <li>{{ HTML::link('/logout', 'Logout') }}</li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </nav>
@show