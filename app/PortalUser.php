<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PortalUser extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'portal_users';

	public function user() {
		return $this->morphOne('App\User', 'userable');
	}
	
}
