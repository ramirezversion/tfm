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

  /**
   *
   */
  public function getFullSystem(){

    $broconfig = new BroConfig;
    $broconfig->hostname = $this->getHostname();

    return $broconfig;

  }


  /**
   *
   */
  public function getHostname(){

    #$net = shell_exec('sudo netstat -antup');
    #chmod u+s /bin/netstat
    $hostname = shell_exec('hostname');
    return (string)$hostname;

  }



}
