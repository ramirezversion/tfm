<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@showLogin');

// It is neccessary to add 'as' => 'login' in the login path to catch the exception for unathenticated request when a user tries to get a resource before the authentication
Route::get('/login', ['as' => 'login', 'uses' => 'PagesController@showLogin']);

Route::post('/login', 'LoginAppController@handleLogin');

Route::post('/logout', ['middleware' => 'auth', 'as' => 'logout', 'uses' => 'LoginAppController@logout']);

Route::get('/home', ['middleware' => 'auth', 'as' => 'home', 'uses' => 'UsersController@getHome']);

Route::get('/dashboard', ['middleware' => 'auth', 'as' => 'dashboard', 'uses' => 'UsersController@getDashboard']);

Route::get('/broconfig', ['middleware' => 'auth', 'as' => 'broconfig', 'uses' => 'UsersController@getBroconfig']);

Route::get('/loginregister', ['middleware' => 'auth', 'as' => 'loginregister', 'uses' => 'UsersController@getLoginRegisters']);
