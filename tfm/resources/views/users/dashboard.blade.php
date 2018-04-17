<?php use App\Http\Controllers\DashboardController;?>

@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>

    <p class="lead">This is the status of the IDS pi system.</p>

    @if(count($dashboard) > 0)

      <p>Memory ussage: {{$dashboard->memorypercent}}</p>
      <p>Disk ussage: {{$dashboard->disk}}</p>
      <p>Kernel version: {{$dashboard->kernel}}</p>
      <p>Number of cores: {{$dashboard->numcores}}</p>
      <p>Number of running processes: {{$dashboard->numproc}}</p>
      <p>Uptime: {{$dashboard->uptime}}</p>

      <p>User: {{Auth::user()->username}}</p>
      <p>User: {{Auth::user()->password}}</p>
      <p>User: {{Auth::user()->remember_token}}</p>

    @endif

@endsection
