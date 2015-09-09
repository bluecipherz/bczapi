<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Task;
use Illuminate\Database\Eloquent\Collection;
use App\Events\TaskCompleted;
use App\Events\TaskPercentChanged;
use DateTime;

class UpdateTask extends Command implements SelfHandling {

    protected $user, $task, $data, $audience;
    
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Task $task, array $data, Collection $audience = null)
	{
		$this->user = $user;
        $this->task = $task;
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
		$percent = $this->task->percentage_completed;
        $this->task->update($this->data);
        if($this->task->percentage_completed != $percent && $this->task->percentage_completed != 100) {
            event(new TaskPercentChanged($this->user, $this->task, $this->audience));
        }
        if($this->task->percentage_completed == 100) {
            $this->task->completed_at = new DateTime;
            $this->task->save();
            event(new TaskCompleted($this->user, $this->task, $this->audience));
        }
	}

}
