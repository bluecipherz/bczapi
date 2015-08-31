<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	protected $fillable = ['name', 'description'];

	public function tasks() {
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
	
	/**
	 * Members involved in this project
	 */
	public function users() {
		return $this->belongsToMany('App\User', 'users_projects');
	}
    
    public function feed() {
        return $this->morphOne('App\Feed', 'feedable');
    }
    
    public function comments() {
		return $this->morphMany('App\Comment', 'commentable');
	}
	
	public function forums() {
		return $this->hasMany('App\Forum');
	}
	
	public function chats() {
		return $this->hasMany('App\Chat');
	}

}
