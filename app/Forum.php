<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model {
	
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
