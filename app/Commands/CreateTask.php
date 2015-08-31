<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Project;
use App\Task;
use App\Events\TaskCreated;

class CreateTask extends Command implements SelfHandling {

	protected $user, $project, $data;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project, $data)
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
		$task = Task::create($this->data);
		$this->project->tasks()->save($task);
		$task->owner()->associate($user);
		event(new TaskCreated($this->user, $this->project, $task));
	}

}
