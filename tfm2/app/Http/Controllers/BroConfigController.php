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
    $broconfig->time = $this->getTime();
    $broconfig->updateTime = $this->getUpdateTime();
    $broconfig->brostatus = $this->getBroStatus();

    return $broconfig;

  }

  /**
   *
   */
  public function getApiTime(){

    $broconfig = new BroConfig;
    $broconfig->time = $this->getTime();

    return $broconfig;

  }

  /**
   *
   */
  public function getHostname(){

    $hostname = shell_exec('hostname');
    return (string)$hostname;

  }

  /**
   *
   */
  public function getTime(){

    $time = shell_exec('date "+%d/%m/%y - %H:%M:%S"');
    return (string)$time;

  }


  /**
   *
   */
  public function getUpdateTime(){

    $updateTime = shell_exec('ls -al /opt/critical-stack/frameworks/intel/ | awk \'END {print $6,$7,$8}\'');
    return (string)$updateTime;

  }


  /**
   *
   */
  public function getBroStatus(){

    $bro_status = shell_exec('sudo broctl status | awk \'END {print $4}\'');
    return (string)$bro_status;

  }


}
