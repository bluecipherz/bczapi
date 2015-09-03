<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Project;
use App\Chat;
use App\Events\ChatRoomCreated;

class CreateChatRoom extends Command implements SelfHandling {

	protected $user, $project, $data;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project = null, array $data)
	{
		$this->user = $user;
		$this->project = $project;
		$this->data = $data;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$chat = Chat::create($this->data);
		$chat->owner()->associate($this->user);
		if($this->project) $chat->project()->associate($this->project);
		event(new ChatRoomCreated($this->user, $this->project, $chat));
		return $chat;
	}

}
