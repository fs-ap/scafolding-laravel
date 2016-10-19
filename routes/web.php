<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('/', function () {
//     return redirect('login');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

	Route::get('chooseTenant', 'ChooseTenantController@index');
	Route::post('chooseTenant', 'ChooseTenantController@store');

	Route::group(['middleware' => 'multitenant'], function() {
	
		Route::group(['prefix' => 'pessoas'], function() {

			Route::get('/home', 'HomeController@index');
			Route::resource('tenants', 'TenantsController');
			Route::resource('usertenants', 'UserTenantsController');
		});
	});
});
