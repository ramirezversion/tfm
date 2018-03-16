<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Acme Login</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>

      <div class="text-center" "container">

        {!! Form::open(['url' => 'login']) !!}

          <div class="form-signin">
             <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
             <h1 class="h3 mb-3 font-weight-normal">Please log in</h1>

             <div class="form-group">
               {{Form::label('username', 'Username', ['for' => 'inputEmail', 'class' => 'sr-only'])}}
               {{Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Username', 'required', 'autofocus'])}}
             </div>

             <div class="form-group">
               {{Form::label('password', 'Password', ['for' => 'inputPassword', 'class' => 'sr-only'])}}
               {{Form::text('password', '', ['class' => 'form-control', 'placeholder' => 'Password', 'required'])}}
             </div>

             <div>
               {{Form::submit('Log in', ['class' => 'btn btn-lg btn-primary btn-block'])}}
             </div>

           </div>

         {!! Form::close() !!}

      </div>

        <footer id="footer" class="text-center">
          <p>Copyright 2018 &copy; Acme</p>
        </footer>
    </body>
</html>
