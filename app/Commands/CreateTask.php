<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Project;
use App\Task;
use App\Events\TaskCreated;
use Illuminate\Database\Eloquent\Collection;

class CreateTask extends Command implements SelfHandling {

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
		$task = Task::create($this->data);
		$this->project->tasks()->save($task);
		$this->user->tasks()->save($task);
		event(new TaskCreated($this->user, $this->project, $task, $this->audience));
		return $task;
	}

}
