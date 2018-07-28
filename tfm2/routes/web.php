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
Route::get('/dashboard', ['middleware' => 'auth', 'as' => 'dashboard', 'uses' => 'DashboardController@getDashboard']);
Route::get('/broconfig', ['middleware' => 'auth', 'as' => 'broconfig', 'uses' => 'BroConfigController@getBroconfig']);
Route::get('/kibana', ['middleware' => 'auth', 'as' => 'kibana', 'uses' => 'UsersController@getKibana']);
Route::get('/loginregister', ['middleware' => 'auth', 'as' => 'loginregister', 'uses' => 'UsersController@getLoginRegisters']);

// Route group for the ApiRest to get data for the dashboard
Route::group(['prefix' => 'api', 'middleware' => 'auth'], function(){
  Route::get('/dashboard/memory', 'DashboardController@getMemoryUsagePercent');
  Route::get('/dashboard/disk', 'DashboardController@getDiskUsage');
  Route::get('/dashboard/cpu', 'DashboardController@getCPUUsagePercent');
  Route::get('/dashboard/numproc', 'DashboardController@getNumberOfProcesses');
  Route::get('/dashboard/kernel', 'DashboardController@getKernelVersion');
  Route::get('/dashboard/numcores', 'DashboardController@getNumberOfCores');
  Route::get('/dashboard/top', 'DashboardController@getTop');
  Route::get('/dashboard/full', 'DashboardController@getFullApi');
  Route::resource('dashboard', 'DashboardController');
});

// Route group for the ApiRest to get data for the bro config
Route::group(['prefix' => 'apibro', 'middleware' => 'auth'], function(){
  Route::get('/broconfig/fullsystem', 'BroConfigController@getFullSystem');
  Route::resource('broconfig', 'BroConfigController');
});
