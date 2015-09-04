<?php namespace App\Handlers\Events;

use App\Events\MemberAdded;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\MemberAction;

class MemberAddition {

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
	 * @param  MemberAdded  $event
	 * @return void
	 */
	public function handle(MemberAdded $event)
	{
		$addAction = MemberAction::create(['action' => 'added']);
		$addAction->admin()->associate($event->admin);
		$addAction->user()->associate($event->user);
		$addAction->memberable()->associate($event->memberable);
	}

}
