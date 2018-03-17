<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\UserData;

class LoginAppController extends Controller
{
    public function submit(Request $request){
      $this->validate($request, [
        'username' => 'required',
        'password' => 'required'
      ]);

      $userdata = new UserData;
      $userdata->username = $request->input('username');
      $userdata->password = $request->input('password');

      // Redirect
      // attempt to do the login
      if (Auth::attempt($userdata)) {

          // validation successful!
          // redirect them to the secure section or whatever
          // return Redirect::to('secure');
          // for now we'll just echo success (even though echoing in a controller is bad
          echo 'SUCCESS'
          return redirect('/')->with('success', 'Log in Succesfull!', $userdata->username);

      } else {

          // validation not successful, send back to form
          return redirect('/login')->with('fail', 'Log in Failed!');

      }

    }

}
