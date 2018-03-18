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

              @if(Request::is('/home'))
                @include('inc.showcase')
              @endif

              <div class="col-md-8 col-lg-8">
                @include('inc.messages')
                @yield('content')
              </div>
              <div class="col-md-4 col-lg-4">
                @include('inc.sidebar')
              </div>

            </div>
        </div>
        <footer id="footer" class="text-center">
          <p>Copyright 2018 &copy; Acme</p>
        </footer>
    </body>
</html>
