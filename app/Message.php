<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

	public function messageable() {
		return $this->morphTo();
	}
	
	public function user() {
		return $this->belongsTo('App\User');
	}
	
	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
	
}
