<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="/home">IDS pi</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{Request::is('home') ? 'active' : ''}}">
        <a class="nav-link" href="/home">Home</a>
      </li>
      <li class="nav-item {{Request::is('dashboard') ? 'active' : ''}}">
        <a class="nav-link" href="/dashboard">Dashboard</a>
      </li>
      <li class="nav-item {{Request::is('broconfig') ? 'active' : ''}}">
        <a class="nav-link" href="/broconfig">Bro Config</a>
      </li>
      <li class="nav-item {{Request::is('loginregister') ? 'active' : ''}}">
        <a class="nav-link" href="/loginregister">Logins</a>
      </li>
      <li class="nav-item {{Request::is('kibana') ? 'active' : ''}}">
        <a class="nav-link" href="/kibana">Log Tool</a>
      </li>
    </ul>

    @if(Auth::check())

      {!! Form::open(['url' => 'logout']) !!}

        <div class="form-inline my-2 my-lg-0">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <div class="nav-link active">
                User: {{Auth::user()->username}}
              </div>
            </li>
          </ul>
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
