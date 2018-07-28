<?php use App\Http\Controllers\BroConfigController;?>

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
      <script src="/js/broconfig.js"></script>

@endsection


@section('content')
    <h1>Bro config 777</h1>

    <h3>aqui algo</h3>

      <p>
        <div ng-app="BroApp" ng-controller="BroController">

        <table id="tableSystem" class="table table-sm table-hover table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Hostname</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">@{{hostname}}</th>
            </tr>
          </tbody>
        </table>
        
      </p>

    </div>

@endsection
