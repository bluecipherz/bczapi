<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Project;
use App\Task;
use App\Events\TaskDeleted;
use Illuminate\Database\Eloquent\Collection;

class DeleteTask extends Command implements SelfHandling {

	protected $user, $project, $task, $audience;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project, Task $task, Collection $audience = null)
	{
		$this->user = $user;
		$this->project = $project;
		$this->task = $task;
		$this->audience = $audience;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
//        $this->task->project_id = null;
//        $this->task->save();
		$this->task->delete();
		event(new TaskDeleted($this->user, $this->project, $this->task, $this->audience));
	}

}
