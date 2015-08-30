<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\NotifiableEvent;

use Illuminate\Queue\SerializesModels;

class StatusUpdated extends Event implements NotifiableEvent {

	use SerializesModels;

	protected $user, $project;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project = null)
	{
		$this->user = $user;
		$this->project = $project;
	}
	
	public function getSubject() {
		return 'Status Updated';
	}
	
	public function getBody() {
		if($this->project) {
			return "{$this->user->email} posted status in project {$this->project->name}";
		} else {
			return "{$this->user->email} posted status";
		}
	}
	
	public function getType() {
		return 'StatusUpdated';
	}

}
