<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Chat;
use App\MemberAction;
use App\Events\ChatUserJoined;

class JoinChat extends Command implements SelfHandling {

	protected $user, $chat, $admin;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Chat $chat, User $admin = null)
	{
		$this->user = $user;
		$this->chat = $chat;
		$this->admin = $admin;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->chat->users()->attach($this->user->id); // belongsToMany
		$action = new MemberAction([
			'action' => ChatUserJoined::class
		]);
		if($this->admin) $action->admin()->associate($this->admin);
		$action->user()->associate($this->user);
		$action->memberable()->associate($this->chat);
//        event(new MemberJoined($this->user, $this->chat, $this->admin));
		event(new ChatUserJoined($this->user, $this->chat, $this->admin));
        return $action;
	}

}
