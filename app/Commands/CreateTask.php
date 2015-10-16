<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Project;
use App\Task;
use App\MileStone;
use App\TaskList;
use App\Events\TaskCreated;
use App\Events\FeedableEvent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CreateTask extends Command implements SelfHandling
// , ShouldBeQueued // queued
{

	// use InteractsWithQueue, SerializesModels; // queued
	protected $user, $project, $tasklist, $data, $audience;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, array $data, Project $project, TaskList $tasklist = null, Collection $audience = null)
	{
		$this->user = $user;
		$this->data = $data;
		$this->project = $project;
		$this->tasklist = $tasklist;
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
		if($this->tasklist) $this->tasklist->tasks()->save($task);
		$task->createdBy()->associate($this->user);
		$task->save();
		if(isset($this->data['owner'])) {
			$user = User::findOrFail($this->data['owner']);
			$user->tasks()->save($task, ['type' => 'owner']);
		} else {
			$this->user->tasks()->save($task, ['type' => 'owner']);
		}
		event(new FeedableEvent('TaskCreated', $this->user, $task, $this->tasklist, $this->project, $this->audience));
		return $task;
	}

}
