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

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::model('projects', 'App\Project');
Route::model('users', 'App\User');
Route::model('tasks', 'App\Task');
		
Route::group(array('prefix' => 'api','after' => 'cors',), function() {
    Route::post('authenticate', 'AuthController@authenticate');
    Route::get('authenticate/user', 'AuthController@getAuthenticatedUser');
    Route::post('register', 'AuthController@register');
    Route::get('authenticate/{user?}', 'AuthController@index');
    Route::group(['middleware' => 'jwt.auth'], function() {
		Route::resource('home', 'HomeController');
        Route::resource('feeds', 'FeedController');
        Route::get('projects/{projects}/users', 'ProjectController@users');
        Route::post('projects/{projects}/users/{users}', 'ProjectController@join');
        Route::delete('projects/{projects}/users/{users}', 'ProjectController@leave');
        Route::resource('projects', 'ProjectController', ['except' => ['create', 'show', 'edit']]);
        Route::get('projects/{projects}/tasks/{tasks}/complete', 'TaskController@complete');
        Route::resource('projects.tasks', 'TaskController');
        Route::resource('projects.forums', 'ForumController');
		Route::resource('status', 'StatusController');
		Route::resource('chats', 'ChatController');
        Route::resource('projects.chats.messages', 'MessageController');
        Route::resource('expenses', 'ExpenseController');
        Route::resource('invoices', 'InvoiceController');
        Route::resource('images', 'ImageController');
		
		// duplicates
		Route::resource('status', 'StatusController');
		Route::resource('chats', 'ChatController');
    });
});

Route::group(['domain' => 'api.bluecipherz.com'], function() {
	Route::get('test', function() { return 'on api subdomain'; });
});

Route::filter('cors', function($route, $request, $response) {
	$response->headers->set('Access-Control-Allow-Origin', 'http://localhost:9000');
});

Route::get('test', function() {
	return ['method' => 'get', \Input::all()];
});

Route::post('test', function() {
	return array_merge(['method' => 'post'], \Input::all());
});
