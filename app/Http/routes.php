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
	/**
	 * Admin auth page
	 */
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
		/**
		 * Dashboard
		 */
		Route::get('dashboard', [
			'as' => 'dashboard',
			'uses' => 'AuthController@dashboard'
		]);

		/**
		 * Users module
		 */
		Route::group(['prefix' => 'users'], function() {
			Route::get('/', [
				'as' => 'user.index',
				'uses' => 'UserController@index',
				'permissions' => 'user.view',
			]);

			Route::get('create', [
				'as' => 'user.create',
				'uses' => 'UserController@create',
				'permissions' => 'user.create',
			]);

			Route::post('/', [
				'as' => 'user.store',
				'uses' => 'UserController@store',
				'permissions' => 'user.store',
			]);

			Route::get('{users}/edit', [
				'as' => 'user.edit',
				'uses' => 'UserController@edit',
				'permissions' => 'user.edit',
			]);

			Route::post('{user}', [
				'as' => 'user.update',
				'uses' => 'UserController@update',
				'permissions' => 'user.update',
			]);

			Route::get('{user}', [
				'as' => 'user.destroy',
				'uses' => 'UserController@destroy',
				'permissions' => 'user.destroy',
			]);
		});

		/**
		 * Roles module
		 */
		Route::group(['prefix' => 'roles'], function() {
			Route::get('/', [
				'as' => 'role.index',
				'uses' => 'RoleController@index',
				'permissions' => 'role.view',
			]);

			Route::get('create', [
				'as' => 'role.create',
				'uses' => 'RoleController@create',
				'permissions' => 'role.create',
			]);

			Route::post('/', [
				'as' => 'role.store',
				'uses' => 'RoleController@store',
				'permissions' => 'role.store',
			]);

			Route::get('{role}/edit', [
				'as' => 'role.edit',
				'uses' => 'RoleController@edit',
				'permissions' => 'role.edit',
			]);

			Route::post('{role}', [
				'as' => 'role.update',
				'uses' => 'RoleController@update',
				'permissions' => 'role.update',
			]);

			Route::get('{role}', [
				'as' => 'role.destroy',
				'uses' => 'RoleController@destroy',
				'permissions' => 'role.destroy',
			]);
		});

		/**
		 * Permissions module
		 */
		Route::group(['prefix' => 'permissions'], function() {
			Route::get('/', [
				'as' => 'permission.index',
				'uses' => 'PermissionController@index',
				'permissions' => 'permission.view',
			]);

			Route::get('create', [
				'as' => 'permission.create',
				'uses' => 'PermissionController@create',
				'permissions' => 'permission.create',
			]);

			Route::post('/', [
				'as' => 'permission.store',
				'uses' => 'PermissionController@store',
				'permissions' => 'permission.store',
			]);

			Route::get('{permission}/edit', [
				'as' => 'permission.edit',
				'uses' => 'PermissionController@edit',
				'permissions' => 'permission.edit',
			]);

			Route::post('{permission}', [
				'as' => 'permission.update',
				'uses' => 'PermissionController@update',
				'permissions' => 'permission.update',
			]);

			Route::get('{permission}', [
				'as' => 'permission.destroy',
				'uses' => 'PermissionController@destroy',
				'permissions' => 'permission.destroy',
			]);
		});

	});
});

Route::get('/', function () {
   return view('welcome');
});

// Route::controller([
//       'auth' => 'Auth\AuthController',
//       'password' => 'Auth\PasswordController'
// ]);
