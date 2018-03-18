<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\LoginRegister;

class LoginAppController extends Controller{

  public function handleLogin(Request $request){

    $this->validate($request, [
      'username' => 'required',
      'password' => 'required'
    ]);

    $userdata = new User;
    $userdata = $request->only('username', 'password');
    $username = Auth::user()->username;
    $loginEntry = new LoginRegister;

    // Redirect
    // attempt to do the login
    if (Auth::attempt($userdata)){
        // validation successful!
        $loginEntry->submitLoginRegister($username);
        return redirect()->intended('home');

    } else {
        // validation not successful, send back to form and show errors
        return back()->withErrors(['Login fail. Please, check your username and password.']);
    }

  }

  public function logout(){

    Auth::logout();
    //return redirect()->route('/login');
    return redirect('/login')->with('success', 'Logout success!');

  }


}
