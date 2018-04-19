<?php use App\Http\Controllers\DashboardController;?>

@extends('layouts.app')

@section('dashboard_javascript')

      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
      <script src="/js/jquery.min.js"></script>
      <script src="/js/angular.min.js"></script>
      <script src="/js/dx.all.js"></script>
      <script src="/js/getmemory.js"></script>

@endsection

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

    @endif

    <p> Dashboard Gauges:
      <div ng-app="GaugeDashApp" ng-controller="GaugeDashController">
        <div class="long-title"><h3>Status</h3></div>
          <div id="gaugeMemory" dx-circular-gauge="gauge.memoryDash"></div>
          <div id="gaugeDisk" dx-circular-gauge="gauge.diskDash"></div>
      </div>
    </p>


@endsection
