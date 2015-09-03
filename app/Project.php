<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	protected $fillable = ['name', 'description'];

	public function tasks() {
		return $this->hasMany('App\Task');
	}
	
	/**
	 * Creator of the project. Stored in same table.
	 */
	public function owner() {
		return $this->belongsTo('App\User', 'user_id');
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
	
	/**
	 * Members involved in this project. Stored in pivot.
	 */
	public function users() {
		return $this->belongsToMany('App\User', 'users_projects');
	}
    
    public function feeds() {
        return $this->morphMany('App\Feed', 'subject');
    }
    
    public function memberActions() {
		return $this->morphMany('App\MemberAction', 'memberable');
	}
    
    public function scopeClients($query) {
		
	}
	
	public function scopeDevelopers($query) {
		
	}

}
