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
    $broconfig->pcapsize = $this->getMaxPcapSize();
    $broconfig->pcapsizeused = $this->getMaxPcapSizeUsed();
    $broconfig->fileextractedsize = $this->getMaxFileExtractedSize();
    $broconfig->fileextractedsizeused = $this->getMaxFileExtractedSizeUsed();
    $broconfig->networks = $this->getBroNetworks();
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
  public function getBroNetworks(){

    $networks = shell_exec('cat /etc/bro/networks.cfg | awk \'NR >4 {print $1}\'');
    return (string)$networks;

  }


  /**
   *
   */
  public function getMaxPcapSize(){

    $pcapsize = shell_exec('cat /nsm/scripts/cleanup | awk \'NR == 3 {print substr($1,13)}\'');
    $pcapsize_float = floatval($pcapsize)/1000000;
    return (string)$pcapsize_float." Gb";

  }


  /**
   *
   */
  public function getMaxPcapSizeUsed(){

    $pcapsizeused = shell_exec('du -h /nsm/pcap/ | awk \'{print $1}\'');
    return (string)$pcapsizeused;

  }


  /**
   *
   */
  public function getMaxFileExtractedSize(){

    $fileextractedsize = shell_exec('cat /nsm/scripts/cleanup | awk \'NR == 4 {print substr($1,16)}\'');
    $fileextractedsize_float = floatval($fileextractedsize)/1000000;
    return (string)$fileextractedsize_float." Gb";

  }


  /**
   *
   */
  public function getMaxFileExtractedSizeUsed(){

    $fileextractedsizeused = shell_exec('du -h /nsm/bro/extracted | awk \'{print $1}\'');
    return (string)$fileextractedsizeused;

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
