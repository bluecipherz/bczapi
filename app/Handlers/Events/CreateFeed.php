<?php namespace App\Handlers\Events;

use App\Event;
use App\Events\Contracts\FeedableEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Feed;
use App\Project;
use App\Services\FeedMessageService;

class CreateFeed {

	protected $feeder;

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(FeedMessageService $feeder)
	{
		$this->feeder = $feeder;
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
		$feed->type = get_class($event);
		
		$feed->origin()->associate($event->getOrigin());
        $feed->subject()->associate($event->getSubject());
        $target = $event->getTarget();
        if($target) { $feed->target()->associate($target); }
        
		$feed->save();
//		echo "\n{$this->feeder->getFeedMessage($feed)}"; // debug
	}

}
