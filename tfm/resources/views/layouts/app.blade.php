<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>IDS pi</title>
        <link rel="stylesheet" href="/css/app.css">

        @yield('dashboard_javascript')

    </head>

    <body>
        @include('inc.navbar')

        <div class="container">

          @if(Route::current()->getName() == 'home')
            @include('inc.showcase')
          @endif

          <div class="row">

            @if(Route::current()->getName() == 'loginregister' || Route::current()->getName() == 'kibana')

              <div class="col-md-12 col-lg-12">
                @include('inc.messages')
                @yield('content')
              </div>

            @else

              <div class="col-md-9 col-lg-9">
                @include('inc.messages')
                @yield('content')
              </div>

              <div class="col-md-3 col-lg-3">
                @include('inc.sidebar')
              </div>

            @endif

          </div>

        </div>

        @include('inc.footer')

    </body>
</html>
