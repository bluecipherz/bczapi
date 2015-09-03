<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {

	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
	
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}
	
	public function feeds() {
		return $this->morphMany('App\Feed', 'subject');
	}
	
	public function project() {
		return $this->belongsTo('App\Project');
	}

}
