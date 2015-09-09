<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model {

	use SoftDeletes;
	
	protected $fillable = ['name', 'description'];

	public function project() {
		return $this->belongsTo('App\Project');
	}

    public function users() {
        return $this->belongsToMany('App\User', 'users_tasks')->withTimestamps()->withPivot('type');
    }
    
	public function owner() {
		return $this->users()->whereType('owner');
	}
	
	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
    
    public function feeds() {
        return $this->morphMany('App\Feed', 'subject');
    }
    
    public function comments() {
		return $this->morphMany('App\Comment', 'commentable');
	}
    
}
