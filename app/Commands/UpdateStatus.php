<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Status;
use App\Project;
use App\Events\StatusUpdated;

class UpdateStatus extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, $data, Project $project = null)
	{
		$this->user = $user;
		$this->data = $data;
		$this->project = $project;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{	
		$status = Status::create($this->data);
		$status->owner()->associate($this->user);
		//~ $status->project()->associate($this->project);
		event(new StatusUpdated($this->user, $this->status, $this->project));
	}

}
