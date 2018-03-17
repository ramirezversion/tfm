<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="/">Acme</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{Request::is('home') ? 'active' : ''}}">
        <a class="nav-link" href="/home">Home</a>
      </li>
      <li class="nav-item {{Request::is('about') ? 'active' : ''}}">
        <a class="nav-link" href="/about">About</a>
      </li>
      <li class="nav-item {{Request::is('contact') ? 'active' : ''}}">
        <a class="nav-link" href="/contact">Contact</a>
      </li>
    </ul>

    @if(Auth::check())

      {!! Form::open(['url' => 'logout']) !!}

        <div class="form-inline my-2 my-lg-0">

          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <div class="nav-link">
                User: {{Auth::user()->username}}
              </div>
            </li>
          </ul>

          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          {{Form::submit('Logout', ['class' => 'btn btn-outline-success my-2 my-sm-0'])}}
        </div>

      {!! Form::close() !!}

    @else

      {!! Form::open(['url' => 'login']) !!}

        <div class="form-inline my-2 my-lg-0">
          {{Form::submit('Login', ['class' => 'btn btn-outline-success my-2 my-sm-0'])}}
        </div>

      {!! Form::close() !!}

    @endif

  </div>
</nav>
