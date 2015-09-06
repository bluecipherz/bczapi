<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Status;
use App\Events\StatusDeleted;

class DeleteStatus extends Command implements SelfHandling {

	protected $user, $status;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Status $status)
	{
		$this->user = $user;
		$this->status = $status;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->status->feeds()->delete();
		$this->status->delete();
		event(new StatusDeleted());
	}

}