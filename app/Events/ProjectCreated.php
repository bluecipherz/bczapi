<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\FeedableEvent;

use Illuminate\Queue\SerializesModels;
use App\User;
use App\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectCreated extends Event implements FeedableEvent {

	use SerializesModels;

	public $project, $user;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project)
	{
		$this->project = $project;
		$this->user = $user;
	}
	
	public function getOrigin() {
		return $this->user;
	}
	
	public function getSubject() {
		return $this->project;
	}
	
	public function getTarget() {
		return null;
	}

}
