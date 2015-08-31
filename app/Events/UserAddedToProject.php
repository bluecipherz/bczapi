<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\FeedableEvent;

use Illuminate\Queue\SerializesModels;
use App\User;
use App\Project;


class UserAddedToProject extends Event implements FeedableEvent {

	use SerializesModels;

	protected $user, $owner, $project;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $owner, Project $project, User $user)
	{
		$this->user = $user;
		$this->owner = $owner;
		$this->project = $project;
	}
	
	public function getFeedable() {
		return $this->user;
	}
	
	public function getTitle() {
		return "{$this->owner->email} added {$this->user->email} to {$this->project->name}";
	}
	
	public function getProject() {
		return $this->project;
	}

}
