<?php use App\Http\Controllers\DashboardController;?>

@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>

    <p class="lead">This is the status of the IDS pi system.</p>

    <!-- @if(count($dashboard) > 0) -->

      <!-- <p>Memory ussage: {{$dashboard->memorypercent}}</p>
      <p>Disk ussage: {{$dashboard->disk}}</p>
      <p>Kernel version: {{$dashboard->kernel}}</p>
      <p>Number of cores: {{$dashboard->numcores}}</p>
      <p>Number of running processes: {{$dashboard->numproc}}</p>
      <p>Uptime: {{$dashboard->uptime}}</p>

      <p>User: {{Auth::user()->username}}</p>
      <p>User: {{Auth::user()->password}}</p>
      <p>User: {{Auth::user()->remember_token}}</p> -->


        <div class="demo-container" ng-app="DemoApp" ng-controller="DemoController">
                <div id="gauge" dx-circular-gauge="gaugeOptions"></div>

          <!-- <script>
            // var memory = '{{$dashboard->memorypercent}}';
            // console.log(memory);

            var xhttp = new XMLHttpRequest();
            var memory2 = 0;

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  memory2 = xhttp.responseText;
                  console.log("Memory ussage:" + memory2);
                  }
            };
            xhttp.open("GET", "/api/dashboard/memory", false);
            xhttp.send();

          </script> -->

        </div>

    <!-- @endif -->

@endsection
