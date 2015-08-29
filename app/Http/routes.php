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

Route::get('start', function() {
	return 'ok1';
});

Route::get('/', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::model('projects', 'App\Project');
Route::model('tasks', 'App\Task');

Route::group(array(['after' => ['cors'], ['domain' => 'api.bluecipherz.com']]), function() {
	// Route::group(array(['middleware' => 'jwt.auth']), function() {
		Route::get('authenticate', 'AuthController@authenticate');
		Route::resource('authenticate', 'AuthController', ['only' => ['index']]);
		Route::resource('projects', 'ProjectController');
		Route::resource('projects.tasks', 'TaskController');
		Route::resource('forums', 'ForumController');
		Route::resource('chats', 'ChatController');
		Route::resource('messages', 'MessageController');
		Route::resource('expenses', 'ExpenseController');
		Route::resource('invoices', 'InvoiceController');
		Route::resource('images', 'ImageController');
	// });	
});

Route::filter('cors', function($route, $request, $response) {
	$response->headers->set('Access-Control-Allow-Origin', 'http://localhost:9000');
});

Route::get('stop', function() {
	return 'ok2';
});
