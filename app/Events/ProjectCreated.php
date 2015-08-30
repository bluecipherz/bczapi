<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\NotifiableEvent;

use Illuminate\Queue\SerializesModels;
use App\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectCreated extends Event implements NotifiableEvent {

	use SerializesModels;

	public $project, $user;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($user, $project)
	{
		$this->project = $project;
		$this->user = $user;
	}
	
	public function getSubject() {
		return 'Project Created';
	}
	
	public function getBody() {
		return "{$this->user->email} created a new project {$this->project->name}";
	}
	
	public function getType() {
		return 'ProjectCreated';
	}

}
