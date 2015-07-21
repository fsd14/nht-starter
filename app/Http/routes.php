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
	Route::get('login', [
		'as' => 'admin.login',
		'uses' => 'AuthController@login'
		]);

	Route::post('login', [
		'as' => 'admin.doLogin',
		'uses' => 'AuthController@authenticate'
		]);

	Route::get('logout', [
		'as' => 'admin.logout',
		'uses' => 'AuthController@logout'
		]);

	Route::group(['middleware' => ['admin', 'acl']], function() {
		// Dashboard
		Route::get('dashboard', [
			'as' => 'dashboard',
			'uses' => 'AuthController@dashboard'
		]);

		/*
		 | POST     | admin/users              | admin.users.store   | Nht\Http\Controllers\Admin\UserController@store
		 | GET|HEAD | admin/users              | admin.users.index   | Nht\Http\Controllers\Admin\UserController@index
		 | GET|HEAD | admin/users/create       | admin.users.create  | Nht\Http\Controllers\Admin\UserController@create
		 | DELETE   | admin/users/{users}      | admin.users.destroy | Nht\Http\Controllers\Admin\UserController@destroy
		 | PUT      | admin/users/{users}      | admin.users.update  | Nht\Http\Controllers\Admin\UserController@update
		 | GET|HEAD | admin/users/{users}/edit | admin.users.edit    | Nht\Http\Controllers\Admin\UserController@edit
		 */

		Route::get('users', [
			'as' => 'user.index',
			'uses' => 'UserController@index',
			'permissions' => 'user.view',
		]);

		Route::get('users/create', [
			'as' => 'user.create',
			'uses' => 'UserController@create',
			'permissions' => 'user.create',
		]);

		Route::post('users', [
			'as' => 'user.store',
			'uses' => 'UserController@store',
			'permissions' => 'user.store',
		]);

		Route::get('users/{users}/edit', [
			'as' => 'user.edit',
			'uses' => 'UserController@edit',
			'permissions' => 'user.edit',
		]);

		Route::put('users/{users}', [
			'as' => 'user.update',
			'uses' => 'UserController@update',
			'permissions' => 'user.update',
		]);

		Route::delete('users/{users}', [
			'as' => 'user.destroy',
			'uses' => 'UserController@destroy',
			'permissions' => 'user.destroy',
		]);
	});
});

Route::get('/', function () {
   return view('welcome');
});

// Route::controller([
//       'auth' => 'Auth\AuthController',
//       'password' => 'Auth\PasswordController'
// ]);
