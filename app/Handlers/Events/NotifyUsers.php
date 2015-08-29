<?php namespace App\Handlers\Events;

use App\Events\ProjectCreated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Events\Contracts\NotifiableEvent;

class NotifyUsers {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * Handle the event.
	 *
	 * @param  ProjectCreated  $event
	 * @return void
	 */
	public function handle(Event $event)
	{
		foreach($event->users as $user) {
			$notification = new Notification;
			$notification->type = $event->getType();
			$notification->subject = $event->getSubject();
			$notification->body = $event->getBody();
			$notification->save();
			$user->notifications()->save($notification);
		}
		return 'ok';
	}

}
