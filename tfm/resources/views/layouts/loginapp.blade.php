<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Acme Login</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        @include('inc.navbarlogin')

        <div class="text-center">
          <div class="container">
            @include('inc.messages')
            @yield('content')
          </div>
        </div>
        <footer id="footer" class="text-center">
          <p>Copyright 2018 &copy; Acme</p>
        </footer>
    </body>
</html>
