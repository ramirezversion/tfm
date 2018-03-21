<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>IDS pi</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>

    <body>
        @include('inc.navbar')

        <div class="container">

          @if(Route::current()->getName() == 'home')
            @include('inc.showcase')
          @endif

          <div class="row">

            @if(Route::current()->getName() == 'loginregister')

              <div class="col-md-12 col-lg-12">
                  @include('inc.messages')
                  @yield('content')
              </div>

            @else

              <div class="col-md-8 col-lg-8">
                @include('inc.messages')
                @yield('content')
              </div>

              <div class="col-md-4 col-lg-4">
                  @include('inc.sidebar')
              </div>

            @endif

          </div>

        </div>

        <footer id="footer" class="text-center">
          <p>Copyright 2018 &copy; Acme</p>
        </footer>

    </body>
</html>
