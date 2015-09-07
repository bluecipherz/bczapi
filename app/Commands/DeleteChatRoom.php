<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Chat;
use Illuminate\Database\Eloquent\Collection;
use App\Events\ChatRoomDeleted;

class DeleteChatRoom extends Command implements SelfHandling {

    protected $user, $chat, $audience;
    
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Chat $chat, Collection $audience = null)
	{
		$this->user = $user;
        $this->chat = $chat;
        $this->audience = $audience;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->chat->delete();
        event(new ChatRoomDeleted($this->user, $this->chat, $this->audience));
	}

}
