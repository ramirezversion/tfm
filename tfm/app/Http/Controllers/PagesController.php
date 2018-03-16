<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getHome(){
      return view('home');
    }

    public function getAbout(){
      return view('about');
    }

    public function getContact(){
      return view('contact');
    }

    public function showLogin(){
      return view('login');
    }

    public function doLogin(){

      // validate the info, create rules for the inputs
      $rules = array(
          'username' => 'required', // make sure the email is an actual email
          'password' => 'required' // password can only be alphanumeric and has to be greater than 3 characters
      );

      $validator = Validator::make(Input::all(), $rules);

      if ($validator->fails()) {
          return Redirect::to('login')
              ->withErrors($validator) // send back all errors to the login form
              ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
      } else {

          // create our user data for the authentication
          $userdata = array(
              'username' => Input::get('username'),
              'password' => Input::get('password')
          );

          // attempt to do the login
          if (Auth::attempt($userdata)) {

              // validation successful!
              // redirect them to the secure section or whatever
              // return Redirect::to('secure');
              // for now we'll just echo success (even though echoing in a controller is bad)
              echo 'SUCCESS!';

          } else {

              // validation not successful, send back to form
              return Redirect::to('login');

          }

        }

    }

}
