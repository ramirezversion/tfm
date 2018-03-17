@extends('layouts.loginapp')

@section('content')
  <div class="form-signin">
    <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please Log In</h1>

    {!! Form::open(['route' => 'handlelogin']) !!}

      <div class="form-group">
        {{Form::label('username', 'Username', ['class' => 'sr-only'])}}
        {{Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Username', 'required', 'autofocus'])}}
      </div>

      <div class="form-group">
        {{Form::label('password', 'Password', ['class' => 'sr-only'])}}
        {{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required', 'autocomplete' => 'off'])}}
      </div>

      <div>
        {{Form::submit('Log in', ['class' => 'btn btn-lg btn-primary btn-lock'])}}
      </div>

    {!! Form::close() !!}
  </div>
@endsection
