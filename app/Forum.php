<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model {

	public function messages() {
		return $this->morphMany('App\Message', 'messageable');
	}
	
	public function user() {
		return $this->belongsTo('App\User');
	}

}
