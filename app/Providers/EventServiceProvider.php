<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'App\Events\ProjectCreated' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\ProjectDeleted' => [
			'App\Handlers\Events\DeleteFeed',
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\TaskCreated' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\TaskCompleted' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\TaskPercentChanged' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\TaskPriorityChanged' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\TaskUsersChanged' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\TaskDeleted' => [
			'App\Handlers\Events\DeleteFeed',
		],
		'App\Events\CommentPosted' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\CommentDeleted' => [
			'App\Handlers\Events\DeleteFeed',
		],
		'App\Events\StatusPosted' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\StatusDeleted' => [
			'App\Handlers\Events\DeleteFeed',
		],
		'App\Events\ChatRoomCreated' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\ChatRoomDeleted' => [
			'App\Handlers\Events\DeleteFeed',
		],
		'App\Events\UserAddedToProject' => [
			'App\Handlers\Events\CreateFeed',
			'App\Handlers\Events\NotifyUser'
		],
		'App\Events\UserRemovedFromProject' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\ForumPosted' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\ForumDeleted' => [
			'App\Handlers\Events\DeleteFeed',
		],
		'App\Events\MessagePosted' => [
			'App\Handlers\Events\NotifyUsers',
		],
		'App\Events\ChatUserJoined' => [
			'App\Handlers\Events\PostMessage',
		],
		'App\Events\ChatUserLeft' => [
			'App\Handlers\Events\PostMessage',
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
