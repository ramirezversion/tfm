@extends('layouts.app')

@section('content')

    <h3>Welcome user: <strong>{{Auth::user()->username}}</strong></h3>

    <p class="lead">Bellow you will find a basic instructions about how to use the system. Enjoy it!</p>

    <p>The system has two users allowed to login.</p>

    <table class="table table-sm table-hover table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Username</th>
          <th scope="col">Password</th>
          <th scope="col">Profile</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">admin</th>
          <td>admin</td>
          <td>Administrator profile with permission to configure all options in the IDS system</td>
        </tr>
        <tr>
          <th scope="row">readonly</th>
          <td>readonly</td>
          <td>User with read only permission to check how the IDS system is configured</td>
        </tr>
      </tbody>
    </table>

    <p class="p_separated">
      <strong>Home:</strong><br>
      You are on this section =). It contains basic instructions for the <strong>IDS pi </strong> system.
    </p>

    <p class="p_separated">
      <strong>Dashboard:</strong><br>
      Here you will find basic statistics about the server in which the IDS pi system is running such as CPU and memory usage, temperature...
    </p>

    <p class="p_separated">
      <strong>Bro Configuration:</strong><br>
      That is the "brain" of the system. Through this section you will be able to modify or view any of the bro configuration parameters.
    </p>

    <p class="p_separated">
      <strong>Logins log:</strong><br>
      This is the log of all the logins succeded or attempted to the system. The <strong>admin</strong> user will see all logins while the <strong>readonly</strong> user will only see its own.
    </p>

@endsection

@section('sidebar')
    @parent
@endsection
