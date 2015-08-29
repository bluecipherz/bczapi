<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\NotifiableEvent;

use Illuminate\Queue\SerializesModels;
use App\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectCreated extends Event implements NotifiableEvent {

	use SerializesModels;

	public $notifiable;
	public $users;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(Project $project, Collection $users)
	{
		$this->notifiable = $project;
		$this->users = $users;
	}
	
	public function getSubject() {
		return 'Project Created';
	}
	
	public function getBody() {
		return '{$this->notifiable->user->username} created a new project {$this->notifiable->name}';
	}
	
	public function getType() {
		return 'ProjectCreated';
	}

}
