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
	public function __construct(User $user, array $data)
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
		// $this->user->ownProjects()->save($project);
		$this->user->projects()->save($project, ['type' => 'owner']);
        // $project->owner()->associate($this->user);
		// $project->save();
		event(new ProjectCreated($this->user, $project));
		return $project;
	}

}
