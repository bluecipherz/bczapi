<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\Project;
use App\Events\ProjectCreated;
use App\User;

class CreateProject extends Command implements SelfHandling {

	protected $data, $user;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, $data)
	{
		$this->user = $user;
		$this->data = $data;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$project = Project::create($this->data);
		$this->user->userable->ownProjects()->save($project);
		event(new ProjectCreated($this->user, $project));
		return $project;
	}

}
