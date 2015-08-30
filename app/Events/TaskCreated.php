<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\NotifiableEvent;

use Illuminate\Queue\SerializesModels;

class TaskCreated extends Event implements NotifiableEvent {

	use SerializesModels;

	protected $user, $project, $task;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project, Task $task)
	{
		$this->user = $user;
		$this->project = $project;
		$this->task = $task;
	}
	
	public function getSubject() {
		return 'TaskCreated Created';
	}
	
	public function getBody() {
		return "{$this->user->email} added a task in {$this->project->name}";
	}
	
	public function getType() {
		return 'TaskCreated';
	}

}
