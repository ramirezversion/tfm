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

Route::get('/login', 'PagesController@showLogin');

Route::post('/login', 'LoginAppController@handleLogin');

Route::post('/logout', ['middleware' => 'auth', 'as' => 'logout', 'uses' => 'LoginAppController@logout']);

Route::get('/home', ['middleware' => 'auth', 'as' => 'home', 'uses' => 'UsersController@getHome']);

Route::get('/about', ['middleware' => 'auth', 'as' => 'about', 'uses' => 'UsersController@getAbout']);
