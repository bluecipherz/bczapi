<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\FeedableEvent;

use Illuminate\Queue\SerializesModels;
use App\User;
use App\Project;
use App\Chat;

class ChatRoomCreated extends Event implements FeedableEvent {

	use SerializesModels;

	protected $user, $project, $chat;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project = null, Chat $chat)
	{
		$this->user = $user;
		$this->chat = $chat;
		$this->project = $project;
	}
	
	public function getSubject() {
		return $this->chat;
	}
	
	public function getOrigin() {
		return $this->user;
	}
	
	public function getTarget() {
		return $this->project;
	}


}
