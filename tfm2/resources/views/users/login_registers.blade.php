@extends('layouts.app')

@section('content')
    <h1>Logins log</h1>

    <p class="lead">Here you have the register of the logins actions.</p>

    @if(count($loginEntries) > 0)

      <table class="table table-sm table-hover table-striped table-bordered">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Username</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($loginEntries as $loginregister)

            @if($loginregister->action == 'Login failed')
              <tr class="table-warning">
            @else
              <tr>
            @endif
                <th scope="row">{{$loginregister->username}}</th>
                <td>{{$loginregister->date}}</td>
                <td>{{$loginregister->time}}</td>
                <td>{{$loginregister->action}}</td>
              </tr>
          @endforeach
        </tbody>
      </table>

    @endif
@endsection
