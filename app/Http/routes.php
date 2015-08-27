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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



Route::group(array('prefix' => 'api','after' => 'cors'), function() {
	Route::resource('todos','TodosController');
	// Route::resource('authenticate', 'AuthController', ['only' => ['index']]);
	Route::post('authenticate', 'AuthController@authenticate');
});



Route::filter('cors', function($route, $request, $response) {
	$response->headers->set('Access-Control-Allow-Origin', 'http://localhost:9000');
});

Route::get('todoapp',function() {
	return view('todoapp.index');
});