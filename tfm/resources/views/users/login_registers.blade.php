@extends('layouts.loginlog')

@section('content')
    <h1>Logins log</h1>
    @if(count($loginEntries) > 0)

      <table class="table table-sm table-hover table-striped">
        <thead class="thead-light">
          <tr>
            <th scope="col">Username</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($loginEntries as $loginregister)
            <tr>
                <th scope="row">{{$loginregister->username}}</th>
                <td>{{$loginregister->date}}</td>
                <td>{{$loginregister->time}}</td>
                <td>{{$loginregister->action}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <!-- @foreach($loginEntries as $loginregister)
        <ul class="list-group">
          <li class="list-group-item">Username: {{$loginregister->username}}</li>
          <li class="list-group-item">Date: {{$loginregister->date}}</li>
          <li class="list-group-item">Time: {{$loginregister->time}}</li>
          <li class="list-group-item">Action: {{$loginregister->action}}</li>
        </ul>
      @endforeach -->
      
    @endif
@endsection
