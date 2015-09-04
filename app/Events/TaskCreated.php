<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\FeedableEvent as FeedableContract;
use App\Events\Traits\FeedableEvent as FeedableTrait;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Queue\SerializesModels;
use App\User;
use App\Project;
use App\Task;

class TaskCreated extends Event implements FeedableContract {

	use SerializesModels;
	use FeedableTrait;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project, Task $task, Collection $audience = null)
	{
		$this->origin = $user;
		$this->context = $project;
		$this->subject = $task;
		$this->audience = $audience;
	}
	
}
