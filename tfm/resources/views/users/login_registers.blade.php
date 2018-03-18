@extends('layouts.loginlog')

@section('content')
    <h1>Logins log</h1>
    @if(count($loginEntries) > 0)
      @foreach($loginEntries as $loginregister)
        <ul class="list-group">
          <li class="list-group-item">Username: {{$loginregister->username}}</li>
          <li class="list-group-item">Date: {{$loginregister->date}}</li>
          <li class="list-group-item">Time: {{$loginregister->time}}</li>
          <li class="list-group-item">Action: {{$loginregister->action}}</li>
        </ul>
      @endforeach
    @endif
@endsection
