<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

	public function project() {
		return $this->belongsTo('App\Project');
	}

	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}
	
	public function completedBy() {
		return $this->belongsTo('App\User');
	}
	
	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
    
    public function feed() {
        return $this->morphOne('App\Feed', 'feedable');
    }
    
    public function comments() {
		return $this->morphMany('App\Comment', 'commentable');
	}
    
}
