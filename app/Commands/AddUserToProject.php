<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Project;
use App\Events\FeedableEvent;
use App\Events\MemberAdded;
use Illuminate\Database\Eloquent\Collection;

class AddUserToProject extends Command implements SelfHandling
// , ShouldBeQueued // queued
 {

	// use InteractsWithQueue, SerializesModels; // queued
	protected $user, $project, $owner, $type, $audience;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $owner, Project $project, User $user, $type, Collection $audience = null)
	{
		$this->owner = $owner;
		$this->project = $project;
		$this->user = $user;
		$this->type = $type;
		$this->audience = $audience;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->project->users()->save($this->user, ['type' => $this->type]); // belongsToMany
		$this->user->feeds()->saveMany($this->project->feeds->all()); // old project feeds
		event(new FeedableEvent('UserAddedToProject', $this->owner, $this->user, null, $this->project, $this->audience));
	}

}
