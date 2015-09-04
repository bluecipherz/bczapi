<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model {

	use SoftDeletes;
	
	protected $fillable = ['name', 'description'];

	public function project() {
		return $this->belongsTo('App\Project');
	}

	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
	}
	
	public function completedBy() {
		return $this->belongsTo('App\User', 'completed_by');
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
