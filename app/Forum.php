<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model {
	
	public function owner() {
		return $this->belongsTo('App\User');
	}
    
    public function users() {
        return $this->belongsToMany('App\User');
    }
    
    public function feeds() {
        return $this->morphMany('App\Feed', 'feedable');
    }
	
	public function comments() {
		return $this->morphMany('App\Comment', 'commentable');
	}

}
