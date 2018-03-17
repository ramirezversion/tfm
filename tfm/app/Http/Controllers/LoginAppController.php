<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginAppController extends Controller
{
  public function handleLogin(Request $request){
    $this->validate($request, [
      'username' => 'required',
      'password' => 'required'
    ]);

    $userdata = new User;
    $userdata->username = $request->input('username');
    $userdata->password = $request->input('password');

    // Redirect
    // attempt to do the login
    if (Auth::attempt($userdata)){
        // validation successful!
        // redirect them to the secure section or whatever
        // return Redirect::to('secure');
        // for now we'll just echo success (even though echoing in a controller is bad
        return "is logged on";
        //return redirect('/')->with('success', 'Log in Succesfull!'. $userdata->username);

    } else {

        // validation not successful, send back to form
        //return redirect('/login')->with('fail', 'Log in Failed!');
        return back()->withInput();
    }
  }
}
