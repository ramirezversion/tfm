<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginRegisterController extends Controller
{

  public function submitLoginRegister(){

    // Create new entry to save the login and the date/time
    $loginEntry = new LoginRegister;
    $now = new DateTime();

    $loginEntry->username = {{Auth::user()->username}};
    $loginEntry->date = $now->format('Y-m-d');
    $loginEntry->time = $now->format('H:i:s');

    // Save message
    $loginEntry->save();
    return;

  }

  public function getLoginRegisters(){

    $loginEntries = LoginRegister::all();
    return view('users.loginRegisters')->with('messages', $loginEntries);

  }

}
