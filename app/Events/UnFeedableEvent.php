<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use App\User;
use App\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class UnFeedableEvent extends Event {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($type, User $origin, Model $subject, Model $context = null, Project $project = null, Collection $audience = null)
	{
		$this->type = $type;
		$this->origin = $origin;
		$this->subject = $subject;
		$this->context = $context;
		$this->project = $project;
		$this->audience = $audience;
	}

	public function getType() {
		return $this->type;
	}

	public function getOrigin() {
		return $this->origin;
	}

	public function getSubject() {
		return $this->subject;
	}

	public function getContext() {
		return $this->context;
	}

	public function getProject() {
		return $this->project;
	}

	public function getAudience() {
		return $this->audience;
	}

}