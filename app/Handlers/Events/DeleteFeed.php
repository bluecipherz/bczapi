<?php namespace App\Handlers\Events;

use App\Events\Event;
use App\Events\Contracts\FeedableEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Feed;

class DeleteFeed {

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
		// $event->getContext() : TaskCompleted Feed
		// $lastFeed : Comment Feed
		if($event instanceof \App\Events\CommentDeleted) {
			// echo 'ok1';
			$lastFeed = Feed::whereType('App\Events\CommentPosted')->whereContextId($event->getContext()->id)->first();
			if($lastFeed) {
				// echo "ok2;{$event->getContext()->comments->count()}";
				if($event->getContext()->comments->count() > 0) {
					$lastComment = $event->getContext()->comments->last();
					// echo "count:{$event->getContext()->comments->count()};last:{$lastComment->owner}";
					$lastFeed->subject()->associate($lastComment);
					$lastFeed->origin()->associate($lastComment->owner);
					$lastFeed->updated_at = $lastComment->updated_at;
					$lastFeed->save();
					// echo "{$lastFeed} : {$lastComment}";
				} else {
					// $event->getContext()->delete();
					$lastFeed->delete();
					echo 'feed deleted';
				}
			}
		} else if($event instanceof \App\Events\ProjectDeleted) {
            Feed::whereContextId($event->getSubject()->id)->whereContextType(get_class($event->getSubject()))->delete();
            Feed::whereSubjectId($event->getSubject()->id)->whereSubjectType(get_class($event->getSubject()))->delete();
		} else {
            Feed::whereSubjectId($event->getSubject()->id)->delete();
        }
	}

}
