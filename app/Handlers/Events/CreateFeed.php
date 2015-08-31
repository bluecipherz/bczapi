<?php namespace App\Handlers\Events;

use App\Event;
use App\Events\Contracts\FeedableEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Feed;
use App\Project;

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
	public function handle(FeedableEvent $event)
	{
		$feed = new Feed;
		$feed->title = $event->getTitle();
		$feed->type = get_class($event);
        $feed->feedable()->associate($event->getFeedable());
        
        $project = $event->getProject();
        if($project) {
			$feed->project()->associate($project);
		}
        
		$feed->save();
	}

}
