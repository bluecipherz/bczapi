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
Route::model('comments', 'App\Comment');
Route::model('feeds', 'App\Feed');
Route::model('statuses', 'App\Status');
Route::model('chats', 'App\Chat');
		
Route::group(array('prefix' => 'api','after' => 'cors'), function() {
    Route::post('authenticate', 'AuthController@authenticate');
    Route::get('authenticate/user', 'AuthController@getAuthenticatedUser');
    Route::post('register', 'AuthController@register');
    Route::get('authenticate/{user?}', 'AuthController@index');
    Route::group(['middleware' => 'jwt.auth'], function() {
		// LINE START ====================================================================
	
		// HOME
		Route::resource('home', 'HomeController', ['only' => ['index']]);
		
		// COMMENTS
		Route::resource('comments', 'CommentController', ['only' => ['store', 'destroy']]);
		
		// FEEDS
        Route::resource('feeds', 'FeedController', ['only' => ['index']]);
		
		// PROJECT
        Route::get('projects/all', 'ProjectController@all');
        Route::get('projects/{projects}/users', 'ProjectController@users');
        Route::post('projects/{projects}/users', 'ProjectController@join');
        Route::post('projects/{projects}/users/{users}', 'ProjectController@updateUser');
        Route::delete('projects/{projects}/users/{users}', 'ProjectController@leave');
        Route::resource('projects', 'ProjectController', ['except' => ['create', 'show', 'edit']]);
		
		// TASK
        Route::post('projects/{projects}/tasks/{tasks}', 'TaskController@complete');
        Route::resource('projects.tasks', 'TaskController', ['except' => ['create', 'show', 'edit']]);
		
		// FORUM
        Route::resource('projects.forums', 'ForumController', ['except' => ['create', 'show', 'edit']]);
		
		// STATUS
		Route::resource('statuses', 'StatusController', ['except' => ['create', 'show', 'edit']]);
		
		// CHAT
        Route::get('chats/{chats}/users', 'ChatController@users');
        Route::post('chats/{chats}/users/{users}', 'ChatController@join');
        Route::delete('chats/{chats}/users/{users}', 'ChatController@leave');
		Route::resource('chats', 'ChatController', ['except' => ['create', 'show', 'edit']]);
		
		// CHAT MESSAGES
        Route::resource('chats.messages', 'MessageController', ['except' => ['create', 'show', 'edit']]);
		
		// LINE ===========================================================
		
		// EXPENSE
        Route::resource('expenses', 'ExpenseController', ['except' => ['create', 'show', 'edit']]);
		
		// INVOICES
        Route::resource('invoices', 'InvoiceController', ['except' => ['create', 'show', 'edit']]);
		
		// IMAGES
        Route::resource('images', 'ImageController', ['except' => ['create', 'show', 'edit']]);
        
        // USERS
        Route::resource('users', 'UserController', ['only' => ['index', 'update', 'destroy']]);
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
