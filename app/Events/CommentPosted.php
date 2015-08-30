<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\NotifiableEvent;

use Illuminate\Queue\SerializesModels;

class CommentPosted extends Event implements NotifiableEvent {

	use SerializesModels;

	protected $user, $commentable;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, $commentable)
	{
		$this->user = $user;
		$this->commentable = $commentable();
	}
	
	public function getSubject() {
		return 'Comment Posted';
	}
	
	public function getBody() {
		return "{$this->user->email} posted comment";
	}
	
	public function getType() {
		return 'CommentPosted';
	}
}
