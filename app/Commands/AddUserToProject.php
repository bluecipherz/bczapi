<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Project;
use App\Events\UserAddedToProject;

class AddUserToProject extends Command implements SelfHandling {

	protected $user, $project, $owner;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $owner, Project $project, User $user)
	{
		$this->owner = $owner;
		$this->project = $project;
		$this->user = $user;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		event(new UserAddedToProject($this->owner, $this->project, $this->user));
	}

}
