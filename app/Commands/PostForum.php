<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Forum;
use App\Project;
use App\Events\ForumPosted;

class PostForum extends Command implements SelfHandling {

	protected $user, $project, $data;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project, $data)
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
		//
	}

}
