<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\BroConfig;

class BroConfigController extends Controller
{

  /**
   *
   */
  public function getBroConfig(){

    return view('users.broconfig');

  }
}
