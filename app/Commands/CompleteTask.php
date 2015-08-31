<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Project;
use App\Task;
use App\Events\TaskCompleted;

class CompleteTask extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project, Task $task)
	{
		$this->user = $user;
		$this->project = $project;
		$this->task = $task;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->task->completedBy()->associate($this->user);
		$this->task->completed_at = new DateTime;
		$this->task->save();
		event(new TaskCompleted($this->user, $this->project, $this->task));
	}

}
