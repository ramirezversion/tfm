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
            @include('inc.messages')
          </div>
        </div>
        <footer id="footer" class="text-center">
          <p>Copyright 2018 &copy; Acme</p>
        </footer>
    </body>
</html>
