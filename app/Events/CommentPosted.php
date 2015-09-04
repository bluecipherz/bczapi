<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\FeedableEvent as FeedableContract;
use App\Events\Traits\FeedableEvent as FeedableTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Queue\SerializesModels;
use App\User;
use App\Comment;

class CommentPosted extends Event implements FeedableContract {

	use SerializesModels;
	use FeedableTrait;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Comment $comment, Model $commentable, Collection $audience = null)
	{
		$this->origin = $user;
		$this->subject = $comment;
		$this->context = $commentable;
		$this->audience = $audience;
	}
	
}
