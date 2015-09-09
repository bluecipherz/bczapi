<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\Project;
use App\Events\ProjectCreated;
use App\User;
use Illuminate\Database\Eloquent\Collection;

class CreateProject extends Command implements SelfHandling {

	protected $data, $user, $audience;

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
//        $audience = User::whereIn($data['audience'])->get();
		event(new ProjectCreated($this->user, $project, $this->audience));
		return $project;
	}

}
