<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Project;
use App\Events\UserAddedToProject;
use App\MemberAction;

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
		$this->project->users()->save($this->user); // belongsToMany
		$addAction = MemberAction::create([
			'action' => UserAddedToProject::class
		]);
		$addAction->admin()->associate($this->owner);
		$addAction->user()->associate($this->user);
		$addAction->memberable()->associate($this->project);
		//~ $this->user->projects()->save($this->project); // belongsToMany : same, works
		event(new UserAddedToProject($this->owner, $this->project, $this->user));
		return $this->user;
	}

}
