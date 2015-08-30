<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\NotifiableEvent;

use Illuminate\Queue\SerializesModels;

class ForumPosted extends Event implements NotifiableEvent {

	use SerializesModels;

	protected $user, $forum;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Forum $forum)
	{
		$this->user = $user;
		$this->forum = $forum;
	}
	
	public function getSubject() {
		return 'Forum Posted';
	}
	
	public function getBody() {
		return "{$this->user->email} posted Forum in {$this->project-name}";
	}
	
	public function getType() {
		return 'ForumPosted';
	}

}
