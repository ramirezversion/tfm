<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Acme</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        @include('inc.navbar')

        <div class="container">

            <div class="row">
              <div class="col-md-12 col-lg-12">
                @include('inc.messages')
                @yield('content')
              </div>

            </div>
        </div>
        <footer id="footer" class="text-center">
          <p>Copyright 2018 &copy; Acme</p>
        </footer>
    </body>
</html>
