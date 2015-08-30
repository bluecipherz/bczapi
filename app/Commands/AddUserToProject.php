<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class AddUserToProject extends Command implements SelfHandling {

	protected $user, $protected;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Project $project)
	{
		$this->user = $user;
		$this->project = $project;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		
	}

}
