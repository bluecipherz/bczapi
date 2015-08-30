<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\NotifiableEvent;

use Illuminate\Queue\SerializesModels;

class TaskCompleted extends Event implements NotifiableEvent {

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
		return 'Task Completed';
	}
	
	public function getBody() {
		return "{$this->user->email} completed Task in {$this->project-name}";
	}
	
	public function getType() {
		return 'TaskCompleted';
	}

}
