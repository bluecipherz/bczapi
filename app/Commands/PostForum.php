<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Forum;
use App\Project;
use App\Events\ForumPosted;

class PostForum extends Command implements SelfHandling {

	protected $user, $project, $data;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project, array $data)
	{
		$this->user = $user;
		$this->project = $project;
		$this->data = $data;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$forum = Forum::create($this->data);
		//~ $forum->owner()->save($this->user); // belongsTo : error
		$forum->owner()->associate($this->user); // belongsTo
		//~ $this->user->forums()->save($forum); // hasMany
		//~ $forum->project()->save($this->project); // belongsTo : error
		$forum->project()->associate($this->project); // belongsTo
		//~ $this->project->forums()->save($forum); // hasMany
		event(new ForumPosted($this->user, $this->project, $forum));
		return $forum;
	}

}
