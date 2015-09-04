<?php namespace App\Handlers\Events;

use App\Events\MemberRemoved;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\MemberAction;

class MemberRemoval {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  MemberRemoval  $event
	 * @return void
	 */
	public function handle(MemberRemoved $event)
	{
		$addAction = MemberAction::create(['action' => 'removed']);
		$addAction->admin()->associate($event->admin);
		$addAction->user()->associate($event->user);
		$addAction->memberable()->associate($event->memberable);
	}

}
