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
		$project = isset($this->data['project']) ? Project::find($this->data['project']) : null;
		$status = Status::create($this->data);
		$this->user->statuses()->save($status);
		// $status->owner()->associate($this->user);
		// $status->save();
		if($project) $project->statuses()->save($status);
		event(new StatusUpdated($this->user, $status, $project));
		return $status;
	}

}
