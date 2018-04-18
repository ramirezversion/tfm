<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>IDS pi</title>
        <link rel="stylesheet" href="/css/app.css">


        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
        <script src="/js/jquery.min.js"></script>
        <!-- <script>window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery-3.1.0.min.js"%3E%3C/script%3E'))</script> -->
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/17.2.7/css/dx.spa.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/17.2.7/css/dx.common.css" />
        <link rel="dx-theme" data-theme="generic.light" href="https://cdn3.devexpress.com/jslib/17.2.7/css/dx.light.css" /> -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script> -->
        <script src="/js/angular.min.js"></script>
        <!-- <script>window.angular || document.write(decodeURIComponent('%3Cscript src="js/angular.min.js"%3E%3C\/script%3E'))</script> -->
        <!-- <script src="https://cdn3.devexpress.com/jslib/17.2.7/js/dx.all.js"></script> -->
        <script src="/js/dx.all.js"></script>
        <script src="/js/getmemory.js"></script>

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

        @include('inc.footer')

    </body>
</html>
