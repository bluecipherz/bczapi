<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\FeedableEvent;

use Illuminate\Queue\SerializesModels;
use App\User;
use App\Comment;

class CommentPosted extends Event implements FeedableEvent {

	use SerializesModels;

	protected $user, $comment, $commentable;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Comment $comment, $commentable)
	{
		$this->user = $user;
		$this->comment = $comment;
		$this->commentable = $commentable;
	}
	
	public function getSubject() {
		return $this->comment;
	}
	
	public function getOrigin() {
		return $this->user;
	}
	
	public function getTarget() {
		return $this->commentable;
	}
}
