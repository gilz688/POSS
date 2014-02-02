<!DOCTYPE html>
<html lang=”en”>
    <head>
        <meta charset="UTF-8" />
        <link
            type="text/css"
            rel="stylesheet"
            href="css/layout.css" />
        <title>
            Point of Sales System
        </title>
    </head>
    <body>
        @include("header")
        <div class="content">
            <div class="container">
                @yield("content")
            </div>
        </div>
        @include("footer")
    </body>
</html>