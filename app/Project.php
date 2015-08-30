<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	protected $fillable = ['name', 'description'];

	public function ownTasks() {
		return $this->hasMany('App\Task');
	}
	
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}
	
	public function messages() {
		return $this->morphMany('App\Message', 'messageable');
	}
	
	public function invoice() {
		return $this->hasOne('App\Invoice');
	}
	
	public function images() {
		return $this->morphMany('App\Image', 'imageable');
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
