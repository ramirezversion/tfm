<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\LoginRegister;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     *
     */
    public function getHome(){

      // Return the view of the Home.
      return view('users.home');

    }

    /**
     *
     */
    public function getDashboard(){

      // Return the view of the Dashboard system
      return view('users.dashboard');

    }

    /**
     *
     */
    public function getBroconfig(){

      // Return the view of the Bro configuration tool
      return view('users.broconfig');

    }

    /**
     *
     */
    public function getLoginRegisters(){

      //Superusers will get all the logins register while a non superuser will get only his own
      if(Auth::user()->super=='1'){
        // Get all users logins entries
        $loginEntries = LoginRegister::orderBy('date', 'desc')->orderBy('time', 'desc')->get();

      } else{
        // Get user logins entries ordered by Date and Time descending
        $loginEntries = LoginRegister::where('username', Auth::user()->username)->orderBy('date', 'desc')->orderBy('time', 'desc')->get();

      }

      // Return the result of the query to the view to print the results
      return view('users.login_registers')->with('loginEntries', $loginEntries);

    }

}
