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
		'App\Events\TaskCreated' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\CommentPosted' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\StatusUpdated' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\TaskCompleted' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\ChatRoomCreated' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\UserAddedToProject' => [
			'App\Handlers\Events\CreateFeed',
		],
		'App\Events\ForumPosted' => [
			'App\Handlers\Events\CreateFeed',
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
