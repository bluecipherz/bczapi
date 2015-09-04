<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use App\User;
use Illuminate\Database\Eloquent\Model;

class MemberRemoved extends Event {

	use SerializesModels;

	public $user, $admin, $memberable;
	
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Model $memberable, User $admin)
	{
		$this->user = $user;
		$this->memberable = $memberable;
		$this->admin = $admin;
	}

}
