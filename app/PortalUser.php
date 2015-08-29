<?php namespace App;

class PortalUser extends User {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'portal_users';

	public function user() {
		return $this->morphOne('App\User', 'userable');
	}
	
	public function projects() {
		return $this->hasMany('App\Project', 'user_id');
	}
	
	public function completedTasks() {
		return $this->hasMany('App\Task', 'completed_by');
	}
	
}
