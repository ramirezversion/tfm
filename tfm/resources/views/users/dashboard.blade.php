<?php use App\Http\Controllers\DashboardController;?>

@extends('layouts.app')

@section('dashboard_javascript')

      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <!-- <script src="/js/jquery.min.js"></script> -->
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script>
      <!-- <script src="/js/angular.min.js"></script> -->
      <script src="https://cdn3.devexpress.com/jslib/17.2.7/js/dx.all.js"></script>
      <!-- <script src="/js/dx.all.js"></script> -->
      <script src="/js/gauges.js"></script>

@endsection

@section('content')
    <h1>Dashboard</h1>

    <p class="lead">This is the status of the IDS pi system.</p>

    <h3>Realtime status</h3>

    <p>
      <div ng-app="GaugeDashApp" ng-controller="GaugeDashController">

          <div id="gaugeMemory" dx-circular-gauge="gauge.memoryDash"></div>
          <div id="gaugeDisk" dx-circular-gauge="gauge.diskDash"></div>
          <div id="gaugeCPU" dx-circular-gauge="gauge.cpuDash"></div>
          <div id="gaugeNumProceses" dx-linear-gauge="gauge.numProcesesDash"></div>
          <div id="gaugeNumCores" dx-linear-gauge="gauge.numCoresDash"></div>

          <table id="tableVersion" class="table table-sm table-hover table-striped table-bordered">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Kernel Version</th>
                <th scope="col">Uptime</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">@{{kernelVersion}}</th>
                <th scope="row">@{{uptime}}</th>
              </tr>
            </tbody>
          </table>

          <table id="tableTop" class="table table-sm table-hover table-striped table-bordered">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Top proceses
                  <button id="toggleMessage" ng-click="toggle=!toggle">
                    @{{toggle ? '-' : '+'}}
                  </button>
                </th>
              </tr>
            </thead>
            <tbody ng-show="toggle">
              <tr>
                <td><pre>@{{top}}</pre></td>
              </tr>
            </tbody>
          </table>

      </div>
    </p>

@endsection
