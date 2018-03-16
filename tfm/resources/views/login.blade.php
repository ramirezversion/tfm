@extends('layouts.loginapp')

@section('content')

    <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please log in</h1>

    {!! Form::open(['url' => 'login']) !!}

      <div class="form-group">
        {{Form::label('username', 'Username', ['for' => 'inputEmail', 'class' => 'sr-only'])}}
        {{Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Username', 'required', 'autofocus'])}}
      </div>

      <div class="form-group">
        {{Form::label('password', 'Password', ['for' => 'inputPassword', 'class' => 'sr-only'])}}
        {{Form::text('password', '', ['class' => 'form-control', 'placeholder' => 'Password', 'required'])}}
      </div>

      <div>
        {{Form::submit('Log in', ['class' => 'btn btn-primary'])}}
      </div>


    {!! Form::close() !!}
@endsection
