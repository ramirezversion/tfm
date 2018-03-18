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

    $username = $request->input('username');
    $loginEntry = new LoginRegister;

    // attempt to do the login
    if (Auth::attempt($userdata)){

        // validation successful!
        // add login register to database
        $loginEntry->submitLoginRegister($username, 'Login successful');

        return redirect()->intended('home');

    } else {

        // validation fail
        // add login register fail to database
        $loginEntry->submitLoginRegister($username, 'Login failed');

        // validation not successful, send back to form and show errors
        return back()->withErrors(['Login fail. Please, check your username and password.']);

    }

  }

  public function logout(){

    $username = Auth::user()->username;
    // add login register to database
    $loginEntry = new LoginRegister;
    $loginEntry->submitLoginRegister($username, 'Logout successful');

    Auth::logout();
    //return redirect()->route('/login');
    return redirect('/login')->with('success', 'Logout success!');

  }

}
