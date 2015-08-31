<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {

	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
	
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}
	
	public function feed() {
		return $this->morphOne('App\Feed', 'feedable');
	}
	
	public function comments() {
		return $this->morphMany('App\Comment', 'commentable');
	}

}
