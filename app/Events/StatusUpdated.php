<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\FeedableEvent;

use Illuminate\Queue\SerializesModels;
use App\User;
use App\Project;
use App\Status;

class StatusUpdated extends Event implements FeedableEvent {

	use SerializesModels;

	protected $user, $project;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Status $status, Project $project = null)
	{
		$this->user = $user;
		$this->status = $status;
		$this->project = $project;
	}
	
	public function getOrigin() {
		return $this->user;
	}
	
	public function getSubject() {
		return $this->status;
	}
	
	public function getTarget() {
		return $this->project;
	}
	
}
