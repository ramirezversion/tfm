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

//Añadir 'as' => 'login' en la ruta de login para capturar la excepcion de unathenticated request y que redirija bien a la ventana de login
Route::get('/login', ['as' => 'login', 'uses' => 'PagesController@showLogin']);

Route::post('/login', 'LoginAppController@handleLogin');

Route::post('/logout', ['middleware' => 'auth', 'as' => 'logout', 'uses' => 'LoginAppController@logout']);

Route::get('/home', ['middleware' => 'auth', 'as' => 'home', 'uses' => 'UsersController@getHome']);

Route::get('/about', ['middleware' => 'auth', 'as' => 'about', 'uses' => 'UsersController@getAbout']);

Route::get('/loginregister', ['middleware' => 'auth', 'as' => 'loginregister', 'uses' => 'UsersController@getLoginRegister']);
