<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\NotifiableEvent;

use Illuminate\Queue\SerializesModels;

class ChatRoomCreated extends Event implements NotifiableEvent {

	use SerializesModels;

	protected $user, $chat;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Chat $chat)
	{
		$this->user = $user;
		$this->chat = $chat;
	}
	
	public function getSubject() {
		return 'Chat Room Created';
	}
	
	public function getBody() {
		return "{$this->user->email} started Chat in {$this->project-name}";
	}
	
	public function getType() {
		return 'ChatRoomCreated';
	}


}
