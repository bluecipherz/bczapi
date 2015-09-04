<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Forum;
use App\Project;
use App\Events\ForumPosted;
use Illuminate\Database\Eloquent\Collection;

class PostForum extends Command implements SelfHandling {

	protected $user, $project, $data, $audience;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project, array $data, Collection $audience = null)
	{
		$this->user = $user;
		$this->project = $project;
		$this->data = $data;
		$this->audience = $audience;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$forum = Forum::create($this->data);
		$forum->owner()->associate($this->user); // belongsTo
		$forum->project()->associate($this->project); // belongsTo
		event(new ForumPosted($this->user, $this->project, $forum, $this->audience));
		return $forum;
	}

}
