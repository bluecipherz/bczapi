<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model {
	
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}
    
    public function feed() {
        return $this->morphOne('App\Feed', 'feedable');
    }
	
	public function comments() {
		return $this->morphMany('App\Comment', 'commentable');
	}
	
	public function project() {
		return $this->belongsTo('App\Project');
	}

}
