<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>IDS pi Login</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        @include('inc.navbarlogin')
        <div class="text-center">
          <div class="container">
            @yield('content')
          </div>
        </div>
        @include('inc.footer')
    </body>
</html>
