<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\FeedableEvent;

use Illuminate\Queue\SerializesModels;
use App\User;
use App\Project;
use App\Task;

class TaskCreated extends Event implements FeedableEvent {

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
	
	public function getTitle() {
		return "{$this->user->email} added a task in {$this->project->name}";
	}
	
	public function getFeedable() {
		return $this->task;
	}
	
	public function getProject() {
		return $this->project;
	}

}
