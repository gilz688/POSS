<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript">var siteloc = "{{ URL::to('/') }}"</script>
    <title>Point of Sales System</title>
    
    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.min.css')}}

    <!-- Custom styles for this template -->
    {{ HTML::style('css/layout.css')}}
    </head>
    <body>
        
                <!-- Bootstrap core JavaScript
        ================================================== -->
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        
        @include("header")
        <div class="content">
            <div class="container">
                @yield("content")
            </div>
        </div>
    
        @include("footer")
     
    </body>
</html>