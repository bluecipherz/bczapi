<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use App\Events\Contracts\FeedableEvent as FeedableContract;
use App\Events\Traits\FeedableEvent as FeedableTrait;
use App\User;
use App\Project;
use App\CheckList;
use Illuminate\Database\Eloquent\Collection;

class CheckListCreated extends Event implements FeedableContract {

	use SerializesModels;
	use FeedableTrait;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project, CheckList $checklist, Collection $collection = null)
	{
		$this->origin = $user;
		$this->context = $project;
		$this->subject = $checklist;
		$this->audience = $collection;
	}

}
