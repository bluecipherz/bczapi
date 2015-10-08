<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Project;
use Illuminate\Database\Eloquent\Collection;
use App\Events\FeedableEvent;

class UpdateProject extends Command implements SelfHandling {

	protected $user, $project, $data, $audience;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project, array $data, Collection $audience = null)
	{
		$this->user = $user;
		$this->project = $project;
		$this->data = $data;
		$this->audience = $audience;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->project->update($this->data);
		event(new FeedableEvent('ProjectUpdated', $this->user, $this->project, null, $this->project, $this->audience));
	}

}
