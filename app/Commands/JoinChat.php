<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Chat;
use App\MemberAction;
use App\Events\FeedableEvent;
use App\Events\ChatUserJoined;
use Illuminate\Database\Eloquent\Collection;

class JoinChat extends Command implements SelfHandling {

	protected $users, $chat, $admin;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Collection $users, Chat $chat, User $admin = null)
	{
		$this->users = $users;
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
		// $this->chat->users()->attach($this->user->id, ['type' => 'member']); // belongsToMany
		$this->chat->users()->attach($this->users->lists('id'), ['type' => 'member']); // belongsToMany
		event(new FeedableEvent('JoinedChat', $this->admin, $this->users, $this->chat));
	}

}
