<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	public function tasks() {
		return $this->hasMany('App\Task');
	}
	
	public function user() {
		return $this->belongsTo('App\PortalUser');
	}
	
	public function messages() {
		return $this->morphMany('App\Message', 'messageable');
	}
	
	public function invoice() {
		return $this->hasOne('App\Invoice');
	}
	
	public function client() {
		return $this->hasOne('App\ClientUser');
	}
	
	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}

}
