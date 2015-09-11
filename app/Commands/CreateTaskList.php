<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class CreateTaskList extends Command implements SelfHandling {

	protected $user, $project, $milestone, $data;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project, MileStone $milestone = null, array $data)
	{
		//
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$tasklist = TaskList::create($this->data);
		$audience = User::whereIn($this->data['audience'])->get();
		event(new TaskListCreated($this->user, $this->project, $this->milestone, $tasklist, $audience));
	}

}
