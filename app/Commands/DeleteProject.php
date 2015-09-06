<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Project;
use App\Events\ProjectDeleted;
use Illuminate\Database\Eloquent\Collection;

class DeleteProject extends Command implements SelfHandling {

	protected $project, $user, $audience;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project, Collection $audience = null)
	{
		$this->user = $user;
		$this->project = $project;
		$this->audience = $audience;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->project->delete();
		event(new ProjectDeleted($this->user, $this->project, $this->audience));
	}

}
