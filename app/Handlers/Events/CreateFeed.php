<?php namespace App\Handlers\Events;

use App\Event;
use App\Events\Contracts\FeedableEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Feed;
use App\Project;
use App\User;
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
        $context = $event->getContext();
        if($context) { $feed->context()->associate($context); }
		$feed->save();
        
        if(isset($event->audience)) {
			foreach($event->audience as $audience) {
				$feed->users()->save($audience);
			}
		} else {
			$users = User::all();
			$feed->users()->saveMany($users->all());
		}
        
//		echo "\n{$this->feeder->getFeedMessage($feed)}"; // debug
	}

}
