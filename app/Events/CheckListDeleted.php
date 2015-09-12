<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;
use App\User;
use App\Project;
use App\CheckList;
use App\Events\Contracts\FeedableEvent as FeedableContract;
use App\Events\Traits\FeedableEvent as FeedableTrait;

class CheckListDeleted extends Event implements FeedableContract {

	use SerializesModels;
	use FeedableTrait;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project, CheckList $checklist, Collection $audience)
	{
		$this->origin = $user;
		$this->context = $project;
		$this->subejct = $checklist;
		$this->audience = $audience;
	}

}
