<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\FeedableEvent;

use Illuminate\Queue\SerializesModels;
use App\User;
use App\Forum;
use App\Project;

class ForumPosted extends Event implements FeedableEvent {

	use SerializesModels;

	protected $user, $project, $forum;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project, Forum $forum)
	{
		$this->user = $user;
		$this->project = $project;
		$this->forum = $forum;
	}
	
	public function getFeedable() {
		return $this->forum;
	}
	
	public function getTitle() {
		return "{$this->user->email} posted Forum in {$this->project->name}";
	}
	
	public function getProject() {
		return $this->project;
	}

}
