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
	
		// HOME
		Route::resource('home', 'HomeController', ['only' => ['index']]);

        // ME
        Route::get('/me/projects', 'MeController@projects');
        Route::get('/me/feeds', 'MeController@feeds');
		
		// FEEDS
        Route::resource('feeds', 'FeedController', ['only' => ['index']]);
        Route::resource('projects.feeds', 'Project\FeedController', ['only' => ['index']]);

        // COMMENTS
        Route::resource('feeds.comments', 'Feed\CommentController', ['only' => ['store', 'destroy']]);
        // Route::resource('projects.feeds.comments', 'Project\Feed\CommentController', ['only' => ['store', 'destroy']]);
		
        // PROJECTS GROUP =============================================================

        // PROJECTS
        Route::get('projects/all', 'ProjectController@all');
        Route::resource('projects', 'ProjectController', ['except' => ['create', 'show', 'edit']]);
        
		// Project namespace
        Route::group(['namespace' => 'Project', 'middleware' => 'project.access'], function() {
            // MILESTONES
            Route::resource('projects.milestones', 'MileStoneController', ['except' => ['create', 'show', 'edit']]);
            // TASKLISTS
            Route::resource('projects.tasklists', 'TaskListController', ['except' => ['create', 'show', 'edit']]);
            Route::resource('projects.milestones.tasklists', 'TaskListController', ['except' => ['create', 'show', 'edit']]);
            // TASKS
            Route::resource('projects.tasks', 'TaskController', ['except' => ['create', 'show', 'edit']]);
            // Project/Milestone namespace
            Route::group(['namespace' => 'MileStone'], function() {
                // TASKLISTS
                Route::resource('projects.milestones.tasks', 'TaskController', ['except' => ['create', 'show', 'edit']]);
                // Project/MileStone/TaskList namespace
                Route::group(['namespace' => 'TaskList'], function() {
                    // TASKLISTS
                    Route::resource('projects.milestones.tasklists.tasks', 'TaskController', ['except' => ['create', 'show', 'edit']]);
                    // Project/MileStone/TaskList/Task namespace
                    Route::group(['namespace' => 'Task'], function() {                            
                        // CHECKLISTS
                        Route::resource('projects.milestones.tasklists.tasks.checklists', 'CheckListController', ['except' => ['create', 'show', 'edit']]);
                        // USERS
                        Route::resource('projects.milestone.tasklists.tasks.users', 'UserController', ['except' => ['create', 'show', 'edit']]);
                    });
                });
            });

            // Project/TaskList namespace
            Route::group(['namespace' => 'TaskList'], function() {
                // TASKLISTS
                Route::resource('projects.tasklists.tasks', 'TaskController', ['except' => ['create', 'show', 'edit']]);
                // Project/TaskList/Task namespace
                Route::group(['namespace' => 'Task'], function() {
                    // CHECKLISTS
                    Route::resource('projects.tasklists.tasks.checklists', 'CheckListController', ['except' => ['create', 'show', 'edit']]);    
                    // USERS
                    Route::resource('projects.tasklists.tasks.users', 'UserController', ['except' => ['create', 'show', 'edit']]);
                });
            });

            // Project/Task namespace
            Route::group(['namespace' => 'Task'], function() {
                // CHECKLISTS
                Route::resource('projects.tasks.checklists', 'CheckListController', ['except' => ['create', 'show', 'edit']]);
                // USERS
                Route::resource('projects.tasks.users', 'UserController', ['except' => ['create', 'show', 'edit']]);
            });

            Route::group(['namespace' => 'User'], function() {
                Route::resource('users.projects', 'ProjectController', ['only' => ['index']]);
                Route::resource('users.profile', 'ProfileController', ['only' => ['index', 'store', 'update']]);
                Route::resource('users.notifications', 'NotificationController', ['except' => ['create', 'edit', 'show']]);
            });

            // CHAT USERS
            Route::resource('projects.chat.users', 'Chat\UserController', ['except' => ['create', 'show', 'edit']]);
            
    		// BUGREPORTS
            Route::resource('projects.bugreports', 'BugReportController', ['except' => ['create', 'show', 'edit']]);                
    		// FORUMS
            Route::resource('projects.forums', 'ForumController', ['except' => ['create', 'show', 'edit']]);
    		// STATUSES
            Route::resource('projects.statuses', 'StatusController', ['except' => ['create', 'show', 'edit']]); // project nested
            // INVOICES
            Route::resource('projects.invoices', 'InvoiceController', ['except' => ['create', 'show', 'edit']]);
    		// CHATS
            Route::resource('projects.chats', 'ChatController', ['except' => ['create', 'show', 'edit']]); // project nested
            // EXPENSES
            Route::resource('projects.expenses', 'ExpenseController', ['except' => ['create', 'show', 'edit']]);
            // USERS
            Route::resource('projects.users', 'UserController', ['except' => ['create', 'show', 'edit']]);

        });
        
        // PROJECTS GROUP END ===========================================================

        // STATUSES
        Route::resource('statuses', 'StatusController', ['except' => ['create', 'show', 'edit']]);

        // CHATS
        Route::resource('chats', 'ChatController', ['except' => ['create', 'show', 'edit']]);
		
		// CHAT MESSAGES
        Route::resource('chats.messages', 'Chat\MessageController', ['except' => ['create', 'show', 'edit']]);

        // EXPENSES
        Route::resource('expenses', 'ExpenseController', ['except' => ['create', 'show', 'edit']]);
		
		// IMAGES
        Route::resource('images', 'ImageController', ['except' => ['create', 'show', 'edit']]);
        
        // USERS
        Route::resource('users', 'UserController', ['only' => ['index', 'update', 'destroy']]);
        Route::resource('chats.users', 'Chat\UserController', ['except' => ['create', 'show', 'edit']]);

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

Route::get('arr_test', function() {
    $audience = App\User::whereIn('id', explode(',', Input::get('audience')))->get();
    if($audience->count()) {
        return 'audience';
    } else {
        return 'no audience';
    }
});
