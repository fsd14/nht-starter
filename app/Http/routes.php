<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
	// Admin auth page
	Route::get('login', 'AuthController@login');
	Route::post('login', 'AuthController@authenticate');
	Route::get('logout', 'AuthController@logout');
	Route::group(['middleware' => 'admin'], function() {
		// Dashboard
		Route::get('dashboard', [
			'as' => 'dashboard',
			'uses' => 'AuthController@dashboard'
		]);

		Route::resource('users', UserController::class);
	});
});

Route::get('/', function () {
   return view('welcome');
});

// Route::controller([
//       'auth' => 'Auth\AuthController',
//       'password' => 'Auth\PasswordController'
// ]);
