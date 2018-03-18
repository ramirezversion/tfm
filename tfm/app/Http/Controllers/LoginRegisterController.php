<?php

namespace App;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoginRegister;

class LoginRegisterController extends Controller
{

  public function getLoginRegisters(){

    $loginEntries = LoginRegister::all();
    return view('users.loginRegisters')->with('messages', $loginEntries);

  }

}
