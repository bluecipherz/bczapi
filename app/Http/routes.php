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
		
		
		// Route::get('backlog', 'BacklogController@index');
		// Route::get('backlog/create', 'BacklogController@create'); // avoid
		// Route::get('backlog/{id}/show', 'BacklogController@show'); // avoid
		// Route::get('backlog/{id}/edit', 'BacklogController@edit'); // avoid
		// Route::post('backlog', 'BacklogController@store');
		// Route::put('backlog/{id}', 'BacklogController@update');
		// Route::delete('backlog/id', 'BacklogController@destroy');

        // ME
        Route::get('/me/projects', 'MeController@projects');
        Route::get('/me/feeds/{project?}', 'MeController@feeds');
        Route::get('/me/notifications', 'MeController@notifications');
        Route::get('/me/tasks', 'MeController@tasks');
        Route::get('/me/tasklists', 'MeController@tasklists');
        Route::get('/me/checklists', 'MeController@checklists');
        Route::get('/me/milestones', 'MeController@milestones');
        Route::get('/me/statuses', 'MeController@statuses');
        
		// FEEDS
        Route::resource('feeds', 'FeedController', ['only' => ['index']]);
        Route::resource('projects.feeds', 'Project\FeedController', ['only' => ['index']]);

        // COMMENTS
        Route::resource('feeds.comments', 'Feed\CommentController', ['only' => ['store', 'destroy']]);
        Route::resource('projects.feeds.comments', 'Project\Feed\CommentController', ['only' => ['store', 'destroy']]);

        // ATTACHMENT
        Route::resource('feeds.comments.attachments', 'Feed\Comment\AttachmentController', ['only' => ['store']]);
		
        // PROJECTS GROUP =============================================================

        // PROJECTS
        Route::get('projects/all', 'ProjectController@all');
        Route::resource('projects', 'ProjectController', ['except' => ['create', 'show', 'edit']]);

        // STORY
        Route::resource('sprints.stories', 'Sprint\StoryController', ['only' => ['update', 'destroy']]);
        
        // TASKS
        Route::resource('tasklists.tasks', 'TaskList\TaskController', ['except' => ['create', 'show', 'edit']]);

		// Project namespace
        Route::group(['namespace' => 'Project', 'middleware' => 'project.access'], function() {
            // SPRINTS
            Route::resource('projects.sprints','SprintController', ['except' => ['create', 'show' , 'edit']]);
			// BACKLOGS
			Route::resource('projects.backlogs', 'BacklogController', ['except' => ['create', 'show', 'edit']]);
            // MILESTONES
            Route::resource('projects.milestones', 'MileStoneController', ['except' => ['create', 'show', 'edit']]);
            // TASKLISTS
            Route::resource('projects.tasklists', 'TaskListController', ['except' => ['create', 'show', 'edit']]);
            Route::resource('projects.milestones.tasklists', 'TaskListController', ['except' => ['create', 'show', 'edit']]);
            // TASKS
            Route::resource('projects.tasks', 'TaskController', ['except' => ['create', 'show', 'edit']]);
            // DOCUMENTS
            Route::resource('projects.documents', 'DocumentController', ['only' => ['index', 'store', 'destroy']]);
            // Project/Milestone namespace
            Route::group(['namespace' => 'MileStone'], function() {
                // TASKLISTS
                Route::resource('projects.milestones.tasklists', 'TaskListController', ['except' => ['create', 'show', 'edit']]);
                // TASK
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
        Route::resource('chats', 'ChatController', ['only' => ['index', 'store', 'update']]); // zoho synced
		
		// CHAT MESSAGES
        Route::resource('chats.messages', 'Chat\MessageController', ['only' => ['index', 'store']]);

        // EXPENSES
        Route::resource('expenses', 'ExpenseController', ['except' => ['create', 'show', 'edit']]);
		
		// IMAGES
        Route::resource('images', 'ImageController', ['except' => ['create', 'show', 'edit']]);
        
        // USERS
        Route::resource('users', 'UserController', ['only' => ['index', 'update', 'destroy']]);
        Route::resource('chats.users', 'Chat\UserController', ['except' => ['create', 'show', 'edit']]);

        // User namespace
        Route::group(['namespace' => 'User'], function() {
            // PROJECT
            Route::resource('users.projects', 'ProjectController', ['only' => ['index']]);
            // PROFILE
            Route::resource('users.profile', 'ProfileController', ['only' => ['index', 'store', 'update']]);
            // NOTIFICATION
            Route::resource('users.notifications', 'NotificationController', ['except' => ['create', 'edit', 'show']]);
        });

        // ATTACHMENTS
        Route::resource('tempupload', 'TempUploadController', ['only' => ['store']]);
    });
});

Route::group(['domain' => 'api.bluecipherz.com'], function() {
	Route::get('test', function() { return 'on api subdomain'; });
});

Route::get('test_old', function() {
    // return substr('App\Feed', strrpos('App\Feed', '\\'));
    $user = \App\User::firstOrFail();
    $feeds = $user->feeds()
        ->with('subject.owner')
        ->with('origin.userable')
        ->with('context')
        ->with('comments')
        ->with('context.context')
        ->orderBy('updated_at')
        ->get();
        
//  $feeds->load(['context.subject' => function($query) {
//		$query->where('type', 'CommentPosted');
//	}]);
	
	$feeds = App\Feed::all()->filter(function($feed) {
		return !App\Feed::whereContextId($feed->id)->whereContextType("App\Feed")->exists();
	});
	
	$feeds = App\Feed::with(['context.origin' => function($query) {
		$query->where('context_id', '!=', 0);
	}])->get();

	
	// $feeds = App\Feed::all()->map(function($feed) {
	// 	if($feed->context_type == 'App\Feed') {
	// 		$feed->context = App\Feed::whereId($feed->context_id)
	// 		->with('subject.owner')
	// 		->with('origin.userable')
	// 		->with('context')
	// 		->with('comments')
	// 		->with('context.context')->get();
	// 	}
	// 	return $feed;
	// })->filter(function($feed) {
	// 	return !App\Feed::whereContextId($feed->id)->whereContextType("App\Feed")->exists();
	// });

    // all round
	// $feeds = App\Feed::with('subject.owner')
 //            ->with('origin.userable')
 //            ->with('comments')
 //            ->orderBy('updated_at')
 //            ->get()->map(function($feed) {
 //        		if($feed->context_type == 'App\Feed') {
 //        			$feed->context = App\Feed::whereId($feed->context_id)
 //        			->with('subject.owner')
 //        			->with('origin.userable')
 //        			->with('context')
 //        			->with('comments')
 //        			->with('context')->first();
 //        		} else {
 //                    $feed->context = $feed->context;
 //                }
 //        		return $feed;
 //        	})->filter(function($feed) {
 //        		return !App\Feed::whereContextId($feed->id)->whereContextType("App\Feed")->exists();
 //            });

    // $feeds->load(['context.subject.owner' => function($query)
    // {
    //     $query->where('type', 'CommentPosted');
    // },
    // 'context.origin.userable' => function ($query)
    // {
    //     $query->where('type', 'CommentPosted');
    // },
    // 'context.context' => function ($query)
    // {
    //     $query->where('type', 'CommentPosted');
    // },
    // 'context.comments' => function ($query)
    // {
    //     $query->where('type', 'CommentPosted');
    // }]);
	return view('test', compact('feeds'));
});

Route::get('test', function() {
    $user = App\User::firstOrFail();
    $project = App\Project::firstOrFail();
    // return response()->json($user->feeds()->whereProjectId($project->id)->count());
    $feeds = App\Feed::with('subject.project')->whereHas('subject', function($q) use ($project) {
        return $q->where('id', '=', $project->id);
    })->count();
    return response()->json($feeds);
});

Route::post('test', function() {
	// return array_merge(['method' => 'post'], \Input::all());
    // return Feed::all()->map(function($feed) {
    //     return $feed;
    // });
    return Input::get('token');
});

Route::get('arr_test', function() {
    $audience = App\User::whereIn('id', explode(',', Input::get('audience')))->get();
    if($audience->count()) {
        return 'audience';
    } else {
        return 'no audience';
    }
});

Route::get('baum', function() {
    $cats = [
      ["name"=>"1 What to do after 10th","parent_id"=>null,"children"=>[
            ["name"=>"Diploma"],
            ["name"=>"higher secondary"],
            ["name"=>"Indian army"],
            ["name"=>"Police force"],
            ["name"=>"Vecational course"],

            ["name"=>"1 What to do after 10th","children"=>[
                  ["name"=>"Diploma"],
                  ["name"=>"higher secondary"],
                  ["name"=>"Indian army"],
                  ["name"=>"Police force"],
                  ["name"=>"Vecational course"],

                  ["name"=>"1 What to do after 10th","children"=>[
                        ["name"=>"Diploma"],
                        ["name"=>"higher secondary"],
                        ["name"=>"Indian army"],
                        ["name"=>"Police force"],
                        ["name"=>"Vecational course"],

                        ["name"=>"1 What to do after 10th","children"=>[
                              ["name"=>"Diploma"],
                              ["name"=>"higher secondary"],
                              ["name"=>"Indian army"],
                              ["name"=>"Police force"],
                              ["name"=>"Vecational course"],

                              ["name"=>"1 What to do after 10th","children"=>[
                                    ["name"=>"Diploma"],
                                    ["name"=>"higher secondary"],
                                    ["name"=>"Indian army"],
                                    ["name"=>"Police force"],
                                    ["name"=>"Vecational course"],
                              ]]
                        ]]
                  ]]
            ]]
        ]]
    ];
    // App\Category::buildTree($cats);
    return App\Category::all()->toHierarchy()->values();
});
