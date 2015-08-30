<?php namespace App\Handlers\Events;

use App\Event;
use App\Events\Contracts\NotifiableEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Feed;

class CreateFeed {

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
	 * @param  Events  $event
	 * @return void
	 */
	public function handle(NotifiableEvent $event)
	{
		$feed = new Feed;
		$feed->subject = $event->getSubject();
		$feed->body = $event->getBody();
        $feed->type = $event->getType();
		$feed->save();
	}

}
