<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model {

	public function messages() {
		return $this->morphMany('App\Message', 'messageable');
	}
	
	public function user() {
		return $this->belongsTo('App\PortalUser');
	}

}
