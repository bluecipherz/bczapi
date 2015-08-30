<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model {

	public function messages() {
		return $this->hasMany('App\Message');
	}
	
	public function owner() {
		return $this->belongsTo('App\User');
	}
	
	public function users() {
		return $this->belongsToMany('App\User');
	}
    

}
