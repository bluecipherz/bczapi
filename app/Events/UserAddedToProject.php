<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\NotifiableEvent;

use Illuminate\Queue\SerializesModels;

class UserAddedToProject extends Event implements NotifiableEvent {

	use SerializesModels;

	protected $user, $admin, $project;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, User $admin, Project $project)
	{
		$this->user = $user;
		$this->admin = $admin;
		$this->project = $project;
	}
	
	public function getSubject() {
		return 'User Added To Project';
	}
	
	public function getBody() {
		return "{$this->admin->email} added {$this->user->email} to {$this->project-name}";
	}
	
	public function getType() {
		return 'UserAddedToProject';
	}

}
