<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Status;
use App\Project;
use App\Events\StatusPosted;
use Illuminate\Database\Eloquent\Collection;

class PostStatus extends Command implements SelfHandling {

	protected $user, $data, $audience, $project;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project = null, array $data, Collection $audience = null)
	{
		$this->user = $user;
		$this->data = $data;
		$this->audience = $audience;
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
		$this->user->statuses()->save($status);
		if($this->project) $this->project->statuses()->save($status);
		event(new StatusPosted($this->user, $status, $this->project, $this->audience));
		return $status;
	}

}
