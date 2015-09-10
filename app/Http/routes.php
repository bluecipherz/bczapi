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
		
		// FEEDS
        Route::resource('feeds', 'FeedController', ['only' => ['index']]);
        Route::resource('projects.feeds', 'Project\FeedController', ['only' => ['index']]);

        // COMMENTS
        Route::resource('feeds.comments', 'Feed\CommentController', ['only' => ['store', 'destroy']]);
        Route::resource('projects.feeds.comments', 'Project\Feed\CommentController', ['only' => ['store', 'destroy']]);
		
		// PROJECTS
        Route::get('projects/all', 'ProjectController@all');
        Route::resource('projects', 'ProjectController', ['except' => ['create', 'show', 'edit']]);
		
        // MILESTONES
        Route::resource('projects.milestones', 'Project\MileStoneController', ['except' => ['create', 'show', 'edit']]);
        
        // TASKLISTS
        Route::resource('projects.tasklists', 'Project\TaskListController', ['except' => ['create', 'show', 'edit']]);
        Route::resource('projects.milestones.tasklists', 'Project\TaskListController', ['except' => ['create', 'show', 'edit']]);
        
		// TASKS
        Route::resource('projects.tasks', 'Project\TaskController', ['except' => ['create', 'show', 'edit']]);
        Route::resource('projects.milestones.tasks', 'Project\MileStone\TaskController', ['except' => ['create', 'show', 'edit']]);
        Route::resource('projects.tasklists.tasks', 'Project\TaskList\TaskController', ['except' => ['create', 'show', 'edit']]);
        Route::resource('projects.milestones.tasklists.tasks', 'Project\MileStone\TaskList\TaskController', ['except' => ['create', 'show', 'edit']]);
        
        // CHECKLISTS
        Route::resource('projects.tasks.checklists', 'Project\Task\CheckListController', ['except' => ['create', 'show', 'edit']]);
        Route::resource('projects.tasklists.tasks.checklists', 'Project\TaskList\Task\CheckListController', ['except' => ['create', 'show', 'edit']]);
        Route::resource('projects.milestones.tasklists.tasks.checklists', 'Project\MileStone\TaskList\Task\CheckListController', ['except' => ['create', 'show', 'edit']]);
        
		// BUGREPORTS
        Route::resource('projects.bugreports', 'Project\BugReportController', ['except' => ['create', 'show', 'edit']]);
        
		// FORUMS
        Route::resource('projects.forums', 'Project\ForumController', ['except' => ['create', 'show', 'edit']]);
		
		// STATUSES
        Route::resource('projects.statuses', 'Project\StatusController', ['except' => ['create', 'show', 'edit']]); // project nested
		Route::resource('statuses', 'StatusController', ['except' => ['create', 'show', 'edit']]);
		
		// CHATS
        Route::resource('projects.chats', 'Project\ChatController', ['except' => ['create', 'show', 'edit']]); // project nested
		Route::resource('chats', 'ChatController', ['except' => ['create', 'show', 'edit']]);
		
		// CHAT MESSAGES
        Route::resource('chats.messages', 'MessageController', ['except' => ['create', 'show', 'edit']]);

        // INVOICES
        Route::resource('projects.invoices', 'InvoiceController', ['except' => ['create', 'show', 'edit']]);

        // EXPENSES
        Route::resource('expenses', 'ExpenseController', ['except' => ['create', 'show', 'edit']]);
        Route::resource('projects.expenses', 'Project\ExpenseController', ['except' => ['create', 'show', 'edit']]);
		
		// LINE ===========================================================
		
		
		// IMAGES
        Route::resource('images', 'ImageController', ['except' => ['create', 'show', 'edit']]);
        
        // USERS
        Route::resource('users', 'UserController', ['only' => ['index', 'update', 'destroy']]);
        Route::resource('chats.users', 'Chat\UserController', ['except' => ['create', 'show', 'edit']]);
        Route::resource('projects.users', 'Project\UserController', ['except' => ['create', 'show', 'edit']]);
        Route::resource('projects.tasks.users', 'Project\Task\UserController', ['except' => ['create', 'show', 'edit']]);
        Route::resource('projects.tasklists.tasks.users', 'Project\TaskList\Task\UserController', ['except' => ['create', 'show', 'edit']]);
        Route::resource('projects.milestone.tasklists.tasks.users', 'Project\MileStone\TaskList\Task\UserController', ['except' => ['create', 'show', 'edit']]);
        Route::resource('projects.chat.users', 'Project\Chat\UserController', ['except' => ['create', 'show', 'edit']]);

        // ATTACHMENTS
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
