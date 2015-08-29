<?php namespace App;

class ClientUser extends User {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'client_users';
	
	public function user() {
		return $this->morphOne('App\User', 'userable');
	}
	
	public function projects() {
		return $this->hasMany('App\Project', 'client_id');
	}

}
