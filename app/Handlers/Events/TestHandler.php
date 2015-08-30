<?php namespace App\Handlers\Events;

use App\Events\TestEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class TestHandler {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		echo 'shitzu';
	}

	/**
	 * Handle the event.
	 *
	 * @param  TestEvent  $event
	 * @return void
	 */
	public function handle(TestEvent $event)
	{
		echo 'fuckzem';
	}

}
