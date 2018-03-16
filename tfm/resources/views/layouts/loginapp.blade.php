<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Acme Log in</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        @include('inc.navbarlogin')

        <div class="container" "text-center">
            <div class="row">
                <div class="col-md-8 col-lg-8">
                  @yield('content')
                </div>
            </div>
        </div>
        <footer id="footer" class="text-center">
          <p>Copyright 2018 &copy; Acme</p>
        </footer>
    </body>
</html>
