@extends('layouts.app')

@section('content')
    <h1>Log Tool</h1>

    <p class="lead">Here you have the full log of the system and Bro.</p>

    <p>
      <iframe src="http://kibana.zero"></iframe>
    </p>

@endsection
