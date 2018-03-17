<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function getAbout(){
      return view('users.about');
    }

    public function getContact(){
      return view('contact');
    }

    public function showLogin(){
      return view('auth.loginauth');
    }

}
