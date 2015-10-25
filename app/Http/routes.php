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
Route::model('backlogs', 'App\Backlog');
Route::model('sprints', 'App\Sprint');
Route::model('users', 'App\User');
Route::model('tasks', 'App\Task');
Route::model('comments', 'App\Comment');
Route::model('feeds', 'App\Feed');
Route::model('statuses', 'App\Status');
Route::model('chats', 'App\Chat');

Route::bind('stories', function($value)
{
    return App\Story::whereIn('id', explode(',', $value))->get();
});
		
Route::group(array('prefix' => 'api'), function() {
    Route::post('authenticate', 'AuthController@authenticate');
    Route::get('authenticate/user', 'AuthController@getAuthenticatedUser');
    Route::post('register', 'AuthController@register'); // TODO changeto something else
    Route::get('authenticate/{user?}', 'AuthController@index');

    Route::group(['middleware' => 'jwt.auth'], function() {
	
		// HOME
		Route::resource('home', 'HomeController', ['only' => ['index']]);

        // ME : NOT SET
        Route::get('/me/projects', 'MeController@projects'); // 2 way ownership
        Route::get('/me/feeds/{project?}', 'MeController@feeds');
        Route::get('/me/activities/{project?}', 'MeController@activities');
        Route::get('/me/notifications', 'MeController@notifications');
        Route::get('/me/statuses', 'MeController@statuses');
        Route::get('/me/backlogs', 'MeController@backlogs');
        Route::get('/me/bugreports', 'MeController@bugreports');
        Route::get('/me/documents', 'MeController@documents');
        Route::get('/me/forums', 'MeController@forums');
        Route::get('/me/sprints', 'MeController@sprints');
        Route::get('/me/stories', 'MeController@stories'); // 2 way ownership

        // COMMENTS : NOT SET
        Route::resource('comments', 'CommentController', ['only' => ['update', 'destroy']]);
        Route::resource('backlogs.comments', 'Backlog\CommentController', ['only' => ['store']]);
        Route::resource('bugreports.comments', 'BugReport\CommentController', ['only' => ['store']]);
        Route::resource('documents.comments', 'Document\CommentController', ['only' => ['store']]);
        Route::resource('forums.comments', 'Forum\CommentController', ['only' => ['store']]);
        Route::resource('projects.comments', 'Project\CommentController', ['only' => ['store']]);
        Route::resource('sprints.comments', 'Sprint\CommentController', ['only' => ['store']]);
        Route::resource('statuses.comments', 'Status\CommentController', ['only' => ['store']]);
        Route::resource('stories.comments', 'Story\CommentController', ['only' => ['store']]);

        // ATTACHMENT


        // NOTIFICATION


        // 

		
        // PROJECTS GROUP =============================================================

        // PROJECTS
        Route::resource('projects', 'ProjectController', ['except' => ['create', 'show', 'edit']]);

        // STORY
        Route::resource('sprints.stories', 'Sprint\StoryController', ['only' => ['update', 'destroy']]);

		// Project namespace
        Route::group(['namespace' => 'Project', 'middleware' => 'project.access'], function() {
            // STORY
            Route::resource('projects.stories', 'StoryController', ['only' => ['index']]);
            // SPRINTS
            Route::resource('projects.sprints','SprintController', ['except' => ['create', 'show' , 'edit']]);
			// BACKLOGS
			Route::resource('projects.backlogs', 'BacklogController', ['except' => ['create', 'show', 'edit']]);
            // DOCUMENTS
            Route::resource('projects.documents', 'DocumentController', ['only' => ['index', 'store', 'destroy']]);            
    		// BUGREPORTS
            Route::resource('projects.bugreports', 'BugReportController', ['except' => ['create', 'show', 'edit']]);                
    		// FORUMS
            Route::resource('projects.forums', 'ForumController', ['except' => ['create', 'show', 'edit']]);
    		// STATUSES
            Route::resource('projects.statuses', 'StatusController', ['only' => ['index', 'store']]); // project nested
            // INVOICES
            Route::resource('projects.invoices', 'InvoiceController', ['except' => ['create', 'show', 'edit']]);
    		// CHATS
            Route::resource('projects.chats', 'ChatController', ['only' => ['index', 'store']]); // project nested
            // EXPENSES
            Route::resource('projects.expenses', 'ExpenseController', ['except' => ['index', 'store']]);
            // USERS
            Route::resource('projects.users', 'UserController', ['except' => ['create', 'show', 'edit']]);
        });
        
        // PROJECTS GROUP END ===========================================================

        // User namespace : NOT SET
        Route::group(['namespace' => 'User'], function() {

            Route::resource('users.projects', 'User/ProjectController', ['only' => ['index']]);
            Route::resource('users.notifications', 'User/NotificationController', ['only' => ['index']]);
            Route::resource('users.statuses', 'User/StatusController', ['only' => ['index']]);
        });

        // STATUSES
        Route::resource('statuses', 'StatusController', ['except' => ['create', 'show', 'edit']]);

        // CHATS
        Route::resource('chats', 'ChatController', ['only' => ['index', 'store', 'update']]); // zoho synced
		
		// CHAT MESSAGES
        Route::resource('chats.messages', 'Chat\MessageController', ['only' => ['index', 'store']]);

        // EXPENSES
        Route::resource('expenses', 'ExpenseController', ['except' => ['create', 'show', 'edit']]);

        // PROFILE


        // TEMPORARY UPLOAD
        Route::resource('tempupload', 'TempUploadController', ['only' => ['store']]);
    });
});
