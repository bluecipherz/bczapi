<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model {

	public function messages() {
		return $this->morphMany('App\Message', 'messageable');
	}
	
	public function owner() {
		return $this->belongsTo('App\User');
	}
    
    public function users() {
        return $this->belongsToMany('App\User');
    }
    
    public function feeds() {
        return $this->morphMany('App\Feed', 'feedable');
    }

}
