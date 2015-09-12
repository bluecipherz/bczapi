<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model {
	
	use SoftDeletes;

	protected $fillable = ['name', 'description'];

	public function milestones() {
		return $this->hasMany('App\MileStone');
	}

	public function tasklists() {
		return $this->hasMany('App\TaskList');
	}

	public function tasks() {
		return $this->hasMany('App\Task');
	}
	
	public function invoice() {
		return $this->hasOne('App\Invoice');
	}
	
	public function images() {
		return $this->morphMany('App\Image', 'imageable');
	}
	
	public function forums() {
		return $this->hasMany('App\Forum');
	}
	
	public function chats() {
		return $this->hasMany('App\Chat');
	}
	
	public function statuses() {
		return $this->hasMany('App\Status');
	}
	
	/**
	 * Members involved in this project. Stored in pivot.
	 */
	public function users() {
		return $this->belongsToMany('App\User', 'users_projects')->withTimestamps()->withPivot('type');
	}
    
    public function feed() {
        return $this->morphOne('App\Feed', 'subject');
    }
    
    public function feeds() {
        return $this->morphMany('App\Feed', 'context');
    }
    
    public function memberActions() {
		return $this->morphMany('App\MemberAction', 'memberable');
	}
    
    public function clients($query) {
		return $this->users()->whereType('client');
	}
	
	public function developers($query) {
		return $this->users()->whereType('developer');
	}
	
	/**
	 * Creator of the project. Stored in same table.
	 */
	public function owner() {
		return $this->users()->whereType('owner');
	}
    
    public function attachments() {
        return $this->morphMany('App\Attachment', 'attachable');
    }

}
