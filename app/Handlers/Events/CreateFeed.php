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
		if($event instanceof \App\Events\CommentPosted) {
			/**
			 * if last feed was a comment on same context, dont create new feed,
			 * instead associate its origin with the new one
			 */
			$lastFeed = Feed::whereType('App\Events\CommentPosted')->whereContextId($event->getContext()->id)->first();
			if($lastFeed) {
				$lastFeed->origin()->associate($event->getOrigin());
				$lastFeed->touch();
				$lastFeed->save();
			} else {
				$this->_createFeed($event);
			}
		} else {
			$this->_createFeed($event);
		}
        
//		echo "\n{$this->feeder->getFeedMessage($feed)}"; // debug
	}
	
	private function _createFeed(FeedableEvent $event) {
		$feed = new Feed;
		$feed->type = get_class($event);
		
		$feed->origin()->associate($event->getOrigin());
		$feed->subject()->associate($event->getSubject());
		$context = $event->getContext();
		if($context) { $feed->context()->associate($context); }
		$feed->save();
		
		if($event->getAudience()) {
			foreach($event->getAudience() as $audience) {
				$feed->users()->save($audience);
			}
		//~ } else if($event->getTarget()->audience) {
			//~ foreach($event->getTarget()->audience as $audience) {
				//~ $feed->users()->save($audience);
			//~ }
		} else {
			$users = User::all();
			$feed->users()->saveMany($users->all());
		}
	}

}
