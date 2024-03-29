<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Dashboard;

class DashboardController extends Controller
{

  /**
   *
   */
  public function getDashboard(){

    return view('users.dashboard');

  }


  /**
   *
   */
  public function getFullApi(){

    $dashboard = new Dashboard;
    $dashboard->memorypercent = $this->getMemoryUsagePercent();
    $dashboard->disk = $this->getDiskUsage();
    $dashboard->cpu = $this->getCPUUsagePercent();
    $dashboard->uptime = $this->getUptime();
    $dashboard->numproc = $this->getNumberOfProcesses();
    $dashboard->kernel = $this->getKernelVersion();
    $dashboard->numcores = $this->getNumberOfCores();
    $dashboard->top = $this->getTop();
    $dashboard->net = $this->getNetstat();

    return $dashboard;

  }


  /**
   *
   */
  public function getNetstat(){

    #$net = shell_exec('sudo netstat -antup');
    #chmod u+s /bin/netstat
    $net = shell_exec('netstat -antup');
    return (string)$net;

  }


  /**
   *
   */
  public function getTop(){

    $top = shell_exec('top -bn 1');
    return (string)$top;

  }


  /**
   *
   */
  public function getCPUUsagePercent(){

    $cmd = "cat /proc/cpuinfo | grep processor | wc -l";
    if ($cmd != ''){
           $cpuCoreNo = intval(trim(shell_exec($cmd)));
    }
    $coreCount = empty($cpuCoreNo) ? 1 : $cpuCoreNo;

    $interval = 1;
    $rs = sys_getloadavg();
    $interval = $interval >= 1 && 3 <= $interval ? $interval : 1;
    $load  = $rs[$interval];
    return round(($load * 100) / $coreCount,2);

  }

  /**
   *
   */
  public function getMemoryUsagePercent(){

  	$free = shell_exec('free');
  	$free = (string)trim($free);
  	$free_arr = explode("\n", $free);
  	$mem = explode(" ", $free_arr[1]);
  	$mem = array_filter($mem);
  	$mem = array_merge($mem);
  	$memory_usage = round ($mem[2] / $mem[1] * 100);
  	return $memory_usage;

  }

  /**
   *
   */
  public function getDiskUsage(){

	   $disktotal = disk_total_space ('/');
	   $diskfree  = disk_free_space  ('/');
	   $diskuse   = round (100 - (($diskfree / $disktotal) * 100));
	   return $diskuse;

  }

  /**
   *
   */
  public function getUptime(){

    $str   = @file_get_contents('/proc/uptime');
    $num   = floatval($str);
    $secs  = fmod($num, 60); $num = (int)($num / 60);
    $mins  = $num % 60;      $num = (int)($num / 60);
    $hours = $num % 24;      $num = (int)($num / 24);
    $days  = $num;

    $uptime = $days . ' days, ' . $hours . ' hours, ' . $mins . ' mins, ' . round($secs) . ' secs';
	  return $uptime;

  }

  /**
   *
   */
  public function getNumberOfProcesses(){

    $proc_count = shell_exec('top -bn 1 | wc -l');
    $proc_count = (int)$proc_count - 8;

	  return $proc_count;

  }

  /**
   *
   */
  public function getKernelVersion(){

	   $kernel = explode(' ', file_get_contents('/proc/version'));
	   $kernel = $kernel[2];
	   return $kernel;

  }

  /**
   *
   */
  function getNumberOfCores(){

    $cmd = "uname";
    $OS = strtolower(trim(shell_exec($cmd)));

    switch($OS) {
       case('linux'):
          $cmd = "cat /proc/cpuinfo | grep processor | wc -l";
          break;
       case('freebsd'):
          $cmd = "sysctl -a | grep 'hw.ncpu' | cut -d ':' -f2";
          break;
       default:
          unset($cmd);
    }

    if ($cmd != '') {
       $cpuCoreNo = intval(trim(shell_exec($cmd)));
    }

    return empty($cpuCoreNo) ? 1 : $cpuCoreNo;

  }

}
