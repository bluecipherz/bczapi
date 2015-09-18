<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Project;
use App\Events\ProjectCreated;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreProjectRequest;

class CreateProject extends Command implements SelfHandling
// , ShouldBeQueued // queued
{

	// use InteractsWithQueue, SerializesModels; // queued
	protected $user, $data, $audience;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, array $data, Collection $audience = null)
	{
		$this->user = $user;
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
		$project = Project::create($this->data);
		$this->user->projects()->save($project, ['type' => 'owner']);
		event(new ProjectCreated($this->user, $project, $this->audience));
		return $project;
	}

}
