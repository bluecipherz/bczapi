<?php namespace App\Events;

use App\Events\Event;
use App\Events\Contracts\FeedableEvent as FeedableContract;
use App\Events\Traits\FeedableEvent as FeedableTrait;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Queue\SerializesModels;
use App\User;
use App\Project;


class UserAddedToProject extends Event implements FeedableContract {

	use SerializesModels;
	use FeedableTrait;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $owner, Project $project, User $user, Collection $audience = null)
	{
		$this->subject = $user;
		$this->origin = $owner;
		$this->context = $project;
		$this->audience = $audience;
	}

}
