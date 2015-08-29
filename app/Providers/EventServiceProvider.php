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
		'App\Event\ProjectCreated' => [
			'App\Handlers\Events\NotifyUsers',
		],
		'App\Event\UserAddedToProject' => [
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Event\TaskAdded' => [
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Event\TaskCompleted' => [
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Event\ProjectStatusUpdate' => [
			'App\Handlers\Events\NotifyUsers',
		],
		'App\Event\ClientAddedToProject' => [
			'App\Handlers\Events\NotifyUsers',
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
