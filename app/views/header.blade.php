@section("header")
    @include("nav")
<header> 
    <div class="container">
        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif
    </div>
</header>
@show