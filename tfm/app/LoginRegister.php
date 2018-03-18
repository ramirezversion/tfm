<?php

namespace App;
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginRegister extends Model
{

  public function submitLoginRegister(User $userdata){

    // Create new entry to save the login and the date/time
    $loginEntry = new LoginRegister;
    $now = new DateTime();

    $loginEntry->username = $userdata->username;
    $loginEntry->date = $now->format('Y-m-d');
    $loginEntry->time = $now->format('H:i:s');

    // Save message
    $loginEntry->save();
    return;

  }

}
