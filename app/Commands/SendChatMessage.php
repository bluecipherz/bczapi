<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Chat;

class SendChatMessage extends Command implements SelfHandling {

	protected $user, $chat, $data;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Chat $chat, array $data)
	{
		$this->user = $user;
		$this->chat = $chat;
		$this->data = $data;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$message = Message::create($this->data);
		$this->user->messages()->save($message);
		$this->chat->messsages()->save($message);
		event(new MessagePosted($this->chat, $message, $this->user));
		return $message;
	}

}
